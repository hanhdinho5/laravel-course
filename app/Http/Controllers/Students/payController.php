<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Checkout;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class payController extends Controller
{
    public function store(Request $request)
    {
        if (!session('cart') || empty(session('cart'))) {
            return redirect()->route('checkout')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $student = Student::findOrFail(currentUserId());
        $cartDetails = [
            'cart' => session('cart', []),
            'cart_details' => session('cart_details', []),
        ];

        $amount = (int) round((float) ($cartDetails['cart_details']['total_amount'] ?? 0));
        if ($amount <= 0) {
            return redirect()->route('checkout')->with('error', 'Không xác định được số tiền thanh toán.');
        }

        $order = DB::transaction(function () use ($student, $amount, $cartDetails) {
            $order = Order::create([
                'student_id' => $student->id,
                'order_code' => $this->generateOrderCode(),
                'amount' => $amount,
                'status' => 0,
                'cart_data' => base64_encode(json_encode($cartDetails, JSON_UNESCAPED_UNICODE)),
            ]);

            foreach (array_keys($cartDetails['cart'] ?? []) as $courseId) {
                $enrollment = Enrollment::firstOrNew([
                    'student_id' => $student->id,
                    'course_id' => (int) $courseId,
                ]);

                if ((int) $enrollment->status === 1) {
                    continue;
                }

                $enrollment->order_code = $order->order_code;
                $enrollment->enrollment_date = now();
                $enrollment->status = 0;
                $enrollment->save();
            }

            return $order;
        });

        $emailStudent = encryptor('decrypt', session('emailAddress'));
        $info = [
            'total' => (float) $amount,
            'email_student' => $emailStudent,
            'name_student' => encryptor('decrypt', session('userName')),
            'order_code' => $order->order_code,
        ];

        Mail::to($emailStudent)->send(new SendMail($cartDetails['cart'], $info));

        session()->put('latest_order_code', $order->order_code);
        session()->forget('cart');
        session()->forget('cart_details');

        return redirect()->route('register.success', ['order_code' => $order->order_code]);
    }

    public function showRegisterSuccess(Request $request)
    {
        $pendingOrder = null;
        $vietQrUrl = null;
        $bankInfo = $this->getBankInfo();

        if (session()->get('studentLogin')) {
            $studentId = currentUserId();
            $orderCode = $request->query('order_code') ?: session('latest_order_code');

            if ($orderCode) {
                $pendingOrder = Order::where('student_id', $studentId)
                    ->where('order_code', $orderCode)
                    ->first();
            }

            if (!$pendingOrder) {
                $pendingOrder = Order::where('student_id', $studentId)
                    ->where('status', 'pending')
                    ->latest('id')
                    ->first();
            }

            if ($pendingOrder) {
                $vietQrUrl = $this->buildVietQrUrl($pendingOrder);
            }
        }

        return view('frontend.register-success', compact('pendingOrder', 'vietQrUrl', 'bankInfo'));
    }

    public function showOrderQr($orderCode)
    {
        $order = Order::where('student_id', currentUserId())
            ->where('order_code', $orderCode)
            ->firstOrFail();

        return view('frontend.register-success', [
            'pendingOrder' => $order,
            'vietQrUrl' => $this->buildVietQrUrl($order),
            'bankInfo' => $this->getBankInfo(),
        ]);
    }

    public function webhook(Request $request)
    {
        $expectedSecret = env('PAYMENT_WEBHOOK_SECRET');
        if (!empty($expectedSecret)) {
            $providedSecret = $request->header('X-Webhook-Secret') ?: $request->input('secret');
            if ($providedSecret !== $expectedSecret) {
                return response()->json(['status' => 'unauthorized'], 401);
            }
        }

        $content = (string) ($request->input('content')
            ?: $request->input('description')
            ?: $request->input('transfer_content')
            ?: $request->input('transferContent')
            ?: $request->input('addInfo'));

        $amount = (float) ($request->input('amount')
            ?: $request->input('transferAmount')
            ?: $request->input('transfer_amount')
            ?: 0);

        if (empty($content) || $amount <= 0) {
            return response()->json(['status' => 'invalid_payload'], 422);
        }

        preg_match('/COURSE\d{14,}/', $content, $matches);
        $orderCode = $matches[0] ?? trim($content);

        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return response()->json(['status' => 'order_not_found'], 404);
        }

        if ((int) round($amount) !== (int) $order->amount) {
            return response()->json(['status' => 'amount_mismatch'], 422);
        }

        if ($order->status === 'paid') {
            return response()->json(['status' => 'already_paid']);
        }

        DB::transaction(function () use ($order, $request) {
            $order->status = 'paid';
            $order->paid_at = now();
            $order->transaction_ref = (string) ($request->input('id')
                ?: $request->input('transaction_id')
                ?: $request->input('reference')
                ?: '');
            $order->save();

            $decoded = json_decode(base64_decode($order->cart_data), true);
            $courses = $decoded['cart'] ?? [];

            foreach (array_keys($courses) as $courseId) {
                Enrollment::updateOrCreate(
                    [
                        'student_id' => $order->student_id,
                        'course_id' => (int) $courseId,
                    ],
                    [
                        'order_code' => $order->order_code,
                        'enrollment_date' => now(),
                        'status' => 1,
                    ]
                );
            }
        });

        return response()->json(['status' => 'success']);
    }

    public function cancel(Request $request)
    {
        $input = $request->all();
        $deposit = Payment::where('txnid', '=', $input['tran_id'])->orderBy('created_at', 'desc')->first();
        $student = Student::findOrFail($deposit->student_id);
        $this->setSession($student);
        return redirect()->route('studentdashboard')->with('danger', 'Payment Cancelled.');
    }

    public function notify(Request $request)
    {
        $cancel_url = action([payController::class, 'cancel']);
        $input = $request->all();
        if ($input['status'] == 'VALID') {
            $deposit = Payment::where('txnid', '=', $input['tran_id'])->orderBy('created_at', 'desc')->first();

            $check = Checkout::where('txnid', '=', $input['tran_id'])->orderBy('created_at', 'desc')->first();
            $check->status = 1;
            $check->save();

            $student = Student::findOrFail($deposit->student_id);
            $this->setSession($student);

            $deposit->status = 1;
            $deposit->save();

            if ($deposit->status == 1) {
                foreach (json_decode(base64_decode($check->cart_data))->cart as $key => $course) {
                    Enrollment::updateOrCreate(
                        [
                            'student_id' => $check->student_id,
                            'course_id' => (int) $key,
                        ],
                        [
                            'order_code' => $check->txnid,
                            'enrollment_date' => now(),
                            'status' => 1,
                        ]
                    );
                }
            }
            return redirect()->route('studentdashboard')->with('success', 'Payment done!');
        }

        return redirect()->route('studentdashboard')->with('danger', 'Vui lòng thử lại!');
    }

    public function setSession($student)
    {
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $student->id),
                'userName' => encryptor('encrypt', $student->name_en),
                'emailAddress' => encryptor('encrypt', $student->email),
                'studentLogin' => 1,
                'image' => $student->image ?? 'No Image Found'
            ]
        );
    }

    private function buildVietQrUrl(Order $order): string
    {
        $bankCode = env('VIETQR_BANK_CODE', 'MB');
        $accountNo = env('VIETQR_ACCOUNT_NO', '01622147641176');
        $template = env('VIETQR_TEMPLATE', 'compact2');

        return "https://img.vietqr.io/image/{$bankCode}-{$accountNo}-{$template}.png?amount={$order->amount}&addInfo={$order->order_code}";
    }

    private function getBankInfo(): array
    {
        return [
            'bank_code' => env('VIETQR_BANK_CODE', 'MB'),
            'bank_name' => env('VIETQR_BANK_NAME', 'MB Bank'),
            'account_no' => env('VIETQR_ACCOUNT_NO', '01622147641176'),
            'account_name' => env('VIETQR_ACCOUNT_NAME', 'LU A HANH'),
        ];
    }

    private function generateOrderCode(): string
    {
        do {
            $code = 'COURSE' . now()->format('YmdHis') . random_int(10, 99);
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }
}
