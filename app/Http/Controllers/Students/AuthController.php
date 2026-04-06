<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\Auth\SignInRequest;
use App\Http\Requests\Students\Auth\SignUpRequest;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function signUpForm()
    {
        return view('students.auth.register');
    }

    public function signUpStore(SignUpRequest $request, $back_route)
    {
        try {
            $student = new Student();
            $student->name_en = $request->name;
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->status = 1;

            if ($student->save()) {
                $this->loginStudent($student);

                return redirect()->route($back_route)->with('success', 'Đăng nhập thành công!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('danger', 'Vui lòng thử lại');
        }
    }

    public function signInForm()
    {
        return view('students.auth.login');
    }

    public function redirectToGoogle(Request $request)
    {
        $backRoute = $this->resolveBackRoute($request->query('back_route'));
        $request->session()->put('student_google.back_route', $backRoute);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $backRoute = $this->resolveBackRoute(
            $request->session()->pull('student_google.back_route', 'studentdashboard')
        );

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $email = $googleUser->getEmail();

            if (empty($email)) {
                return redirect()
                    ->route('studentLogin')
                    ->with('error', 'Không lấy được email từ Google. Vui lòng chọn tài khoản Google hợp lệ.');
            }

            $student = Student::where('email', $email)->first();

            if ($student) {
                if ((int) $student->status !== 1) {
                    return redirect()
                        ->route('studentLogin')
                        ->with('error', 'Tài khoản của bạn chưa hoạt động. Vui lòng liên hệ quản trị viên.');
                }

                $this->loginStudent($student);

                return redirect()
                    ->route($backRoute)
                    ->with('success', 'Đăng nhập thành công!');
            }

            $student = new Student();
            $student->name_en = $googleUser->getName() ?: Str::before($email, '@');
            $student->email = $email;
            $student->password = Hash::make(Str::random(32));
            $student->status = 1;
            $student->image = $this->downloadGoogleAvatar($googleUser->getAvatar());
            $student->save();

            $this->loginStudent($student);

            return redirect()
                ->route($backRoute)
                ->with('success', 'Đăng nhập thành công!');
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('studentLogin')
                ->with('error', 'Đăng nhập Google thất bại. Vui lòng thử lại.');
        }
    }

    public function signInCheck(SignInRequest $request, $back_route)
    {
        try {
            $student = Student::where('email', $request->email)->first();

            if ($student) {
                if ((int) $student->status === 1) {
                    if (Hash::check($request->password, $student->password)) {
                        $this->loginStudent($student);

                        return redirect()->route($back_route)->with('success', 'Đăng nhập thành công!');
                    }

                    return redirect()->back()->with('error', 'Tên người dùng hoặc mật khẩu không đúng!');
                }

                return redirect()->back()->with('error', 'Tài khoản của bạn chưa hoạt động. Vui lòng liên hệ quản trị viên.');
            }

            return redirect()->back()->with('error', 'Tên người dùng hoặc mật khẩu không đúng!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Tên người dùng hoặc mật khẩu không đúng!');
        }
    }

    public function setSession($student)
    {
        return request()->session()->put([
            'userId' => encryptor('encrypt', $student->id),
            'userName' => encryptor('encrypt', $student->name_en),
            'emailAddress' => encryptor('encrypt', $student->email),
            'studentLogin' => 1,
            'image' => $student->image ?? null,
        ]);
    }

    protected function loginStudent(Student $student): void
    {
        session()->flush();
        $this->setSession($student);
    }

    protected function resolveBackRoute(?string $backRoute): string
    {
        if (!empty($backRoute) && Route::has($backRoute)) {
            return $backRoute;
        }

        return 'studentdashboard';
    }

    protected function downloadGoogleAvatar(?string $avatarUrl): ?string
    {
        if (empty($avatarUrl)) {
            return null;
        }

        $avatarContents = @file_get_contents($avatarUrl);

        if ($avatarContents === false) {
            return null;
        }

        $directory = public_path('uploads/students');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'google_' . Str::random(20) . '.jpg';
        file_put_contents($directory . DIRECTORY_SEPARATOR . $filename, $avatarContents);

        return $filename;
    }

    public function signOut()
    {
        request()->session()->flush();

        return redirect()->route('studentLogin')->with('danger', 'Đã đăng xuất');
    }
}