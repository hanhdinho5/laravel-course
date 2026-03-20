@extends('frontend.layouts.app')
@section('title', 'Register-success')
@section('body-attr') style="background-color: #ebebf2;" @endsection

@section('content')
    <div class="py-0">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 align-items-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="fs-6 text-secondary">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('checkout') }}" class="fs-6 text-secondary">Đăng
                            ký</a></li>
                    <li class="breadcrumb-item active"><a href="#" class="fs-6 text-secondary">Thanh toán</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <section>
        <div class="container py-4">
            @if (request()->session()->get('studentLogin'))
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 my-4">
                        <div class="card border-0 shadow-lg p-4 p-lg-5 rounded-4"
                            style="background: linear-gradient(135deg, #f9fafc, #eef2f7);">
                            <h2 class="fw-bold text-success mb-3">Đăng ký thành công, vui lòng thanh toán</h2>
                            <p class="fs-6 text-secondary mb-4">
                                Email xác nhận đã được gửi. Hệ thống sẽ tự động mở khóa học khi nhận dạng giao dịch chuyển
                                khoản.
                            </p>

                            @if (!empty($pendingOrder))
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-5 text-center">
                                        <img src="{{ $vietQrUrl }}" alt="VietQR thanh toán"
                                            class="img-fluid rounded-3 border" style="max-width: 320px;">
                                    </div>

                                    <div class="col-lg-7">
                                        <h5 class="mb-3">Thông tin chuyển khoản</h5>

                                        <p class="mb-1"><strong>Mã đơn:</strong> {{ $pendingOrder->order_code }}</p>

                                        <p class="mb-1">
                                            <strong>Ngân hàng:</strong> {{ $bankInfo['bank_name'] }}
                                            ({{ $bankInfo['bank_code'] }})
                                        </p>

                                        <p class="mb-1">
                                            <strong>Số tài khoản:</strong> {{ $bankInfo['account_no'] }}
                                        </p>

                                        <p class="mb-1">
                                            <strong>Chủ tài khoản:</strong> {{ $bankInfo['account_name'] }}
                                        </p>

                                        <p class="mb-1">
                                            <strong>Số tiền:</strong>
                                            {{ number_format((float) $pendingOrder->amount, 0) }} VND
                                        </p>

                                        <p class="mb-3">
                                            <strong>Nội dung chuyển khoản:</strong>
                                            <span class="text-danger">{{ $pendingOrder->order_code }}</span>
                                        </p>

                                        @if ($pendingOrder->status === 'paid')
                                            <div class="alert alert-success mb-3">
                                                Đơn đã thanh toán. Khóa học đã được mở.
                                            </div>
                                        @else
                                            <div class="alert alert-warning mb-3">
                                                Đơn đang chờ thanh toán. Tải lại trang nếu bạn đã thanh toán.
                                            </div>
                                        @endif

                                        <a href="{{ route('studentdashboard') }}" class="btn btn-outline-primary me-2">
                                            Mở dashboard
                                        </a>

                                        <a href="{{ route('home') }}" class="btn btn-primary">
                                            Về trang chủ
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info mb-3">
                                    Không tìm thấy đơn hàng chờ thanh toán.
                                </div>

                                <a href="{{ route('studentdashboard') }}" class="btn btn-outline-primary me-2">
                                    Mở dashboard
                                </a>

                                <a href="{{ route('home') }}" class="btn btn-primary">
                                    Về trang chủ
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 my-4">
                        <div class="card border-0 shadow p-4 text-center">
                            <h4 class="mb-3">Bạn cần đăng nhập để xem mã thanh toán</h4>

                            <a href="{{ route('studentLogin') }}" class="btn btn-primary me-2">
                                Đăng nhập
                            </a>

                            <a href="{{ route('studentRegister') }}" class="btn btn-outline-primary">
                                Đăng ký
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if (request()->session()->get('studentLogin') && !empty($pendingOrder) && $pendingOrder->status !== 'paid')
        {{-- <script>
            setTimeout(function() {
                window.location.reload();
            }, 5000);
        </script> --}}
    @endif
@endsection
