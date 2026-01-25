@extends('frontend.layouts.app')
@section('title', 'Cart')
@section('body-attr')style="background-color: #ebebf2;"@endsection

@section('content')
    <!-- Breadcrumb Starts Here -->
    <div class="py-0">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="index.html" class="fs-6 text-secondary">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="cart.html" class="fs-6 text-secondary">Giỏ hàng</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb Ends Here -->

    <!-- Cart Section Starts Here -->
    <section class="section cart-area pb-0">
        <div class="container">
            @if (session('cart'))
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="cart-area__label">{{ count(session('cart', [])) }} khóa học trong giỏ hàng</h6>
                        @php $total = 0 @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <div class="cart-wizard-area">
                                    <div class="image">
                                        <img src="{{ asset('uploads/courses/' . $details['image']) }}" alt="course image" />
                                    </div>
                                    <div class="text">
                                        <h6><a
                                                href="{{ route('courseDetails', encryptor('encrypt', $id)) }}">{{ $details['title'] }}</a>
                                        </h6>
                                        <p>Giảng viên: <a href="#">{{ $details['instructor'] }}</a></p>
                                        <div class="bottom-wizard d-flex justify-content-between align-items-center">
                                            <p>
                                                {{ $details['price'] ? $details['price'] . 'VNĐ' : 'Free' }}
                                                <span><del>{{ $details['old_price'] ? $details['old_price'] . 'VNĐ' : '' }}</del></span>
                                            </p>
                                            <div class="trash-icon">
                                                <a href="#" class="remove-from-cart" data-id="{{ $id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <h6 class="cart-area__label">Tóm tắt</h6>
                        <div class="summery-wizard">
                            <div class="summery-wizard-text pt-0">
                                <h6>Tổng phụ</h6>
                                <p> {{ number_format((float) session('cart_details')['cart_total'], 2) . 'VNĐ' }}</p>
                            </div>
                            <div class="summery-wizard-text">
                                <h6>Phiếu giảm giá ({{ session('cart_details')['discount'] ?? 0.0 }}%)</h6>
                                <p>{{ number_format((float) isset(session('cart_details')['discount_amount']) ? session('cart_details')['discount_amount'] : 0.0, 2) . 'VNĐ' }}
                                </p>
                            </div>
                            <div class="summery-wizard-text">
                                <h6>Thuế (15%)</h6>
                                <p> {{ number_format((float) session('cart_details')['tax'], 2) . 'VNĐ' }}</p>
                            </div>
                            <div class="total-wizard">
                                <h6 class="font-title--card">Tổng cộng:</h6>
                                <p class="font-title--card">
                                    {{ number_format((float) session('cart_details')['total_amount'], 2) . 'VNĐ' }}</p>
                            </div>
                            <a href="{{ route('checkout') }}"
                                class="button button-lg button--primary-outline mt-3 w-100">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
            @else
                <section class="section cart-area pb-0">
                    <div class="container text-center">
                        <h1>Giỏ hàng của bạn đang trống</h1>
                        <h5>Chưa có khóa học nào trong giỏ hàng của bạn</h5>
                    </div>
                </section>
            @endif
        </div>
    </section>

    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="confirmRemoveModal" tabindex="-1" aria-labelledby="confirmRemoveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmRemoveModalLabel">Xác nhận xóa khóa học</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa khóa học này khỏi giỏ hàng không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Section Ends Here -->
@endsection

@push('scripts')
    <script>
        let removeId = null;

        // Khi bấm icon thùng rác
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            removeId = $(this).data('id'); // lưu id cần xóa
            var removeModal = new bootstrap.Modal(document.getElementById('confirmRemoveModal'));
            removeModal.show();
        });

        // Khi xác nhận xóa trong modal
        $("#confirmRemoveBtn").click(function() {
            if (removeId) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: removeId
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endpush
