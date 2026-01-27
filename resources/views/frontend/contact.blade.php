@extends('frontend.layouts.app')
@section('title', 'Liên hệ')
@section('header-attr') class="nav-shadow" @endsection

@section('content')

    <!-- Breadcrumb Starts Here -->
    <div class="py-0 section--bg-white">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb pb-0 mb-0">
                    <li class="breadcrumb-item"><a href="index.html" class="fs-6 text-secondary">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><a href="contact.html" class="fs-6 text-secondary">Liên hệ</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb Ends Here -->

    <!-- Contact Hero Area Starts Here -->
    <section class="section section--bg-white hero hero--one">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero__img-content">
                        <div class="hero__img-content--main">
                            <img src="{{ asset('frontend/dist/images/contact/image.jpg') }}" alt="Hình ảnh" />
                        </div>
                        <img src="{{ asset('frontend/dist/images/shape/dots/dots-img-02.png') }}" alt="Hình dạng"
                            class="hero__img-content--shape-01" />
                        <img src="{{ asset('frontend/dist/images/shape/rec05.png') }}" alt="Hình dạng"
                            class="hero__img-content--shape-02" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__content-info">
                        <h2 class="font-title--md mb-0">Các Chi Nhánh Của Chúng Tôi</h2>
                        <p class="font-para--lg">
                            Chúng tôi luôn tạo ra một môi trường học tập thuận lợi và năng động. Mỗi trải nghiệm đều được
                            thiết kế cẩn thận để hỗ trợ sự phát triển của học viên. Chúng tôi kết hợp phương pháp giảng dạy
                            hiện đại với các công cụ học tập hiệu quả, mang đến kết quả tối ưu.
                        </p>
                        <ul class="hero__content-location">
                            <li>
                                <span><i class="fas fa-map-marker-alt fa-2x"></i></span>
                                <p>Cầu Giấy, Hà Nội</p>
                            </li>
                            <li>
                                <span><i class="fas fa-map-marker-alt fa-2x"></i></span>
                                <p>Tp. Hồ Chí Minh</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Get in Touch Area Starts Here -->
    <section class="section getin-touch overflow-hidden"
        style="background-image: url({{ asset('frontend/dist/images/contact/bg.png') }});">
        <div class="container">
            <div class="row">
                <h2 class="font-title--md text-center">Liên Hệ Với Chúng Tôi</h2>
                <div class="col-lg-5 pe-lg-4 position-relative mb-4 mb-lg-0">
                    <div class="contact-feature d-flex align-items-center">
                        <div class="contact-feature-icon primary-bg">
                            <i class="fas fa-map-marked-alt fa-2x"></i>
                        </div>
                        <div class="contact-feature-text">
                            <h6>Địa chỉ</h6>
                            <p>TOÀ AN BÌNH PLAZA 97 Số 97 Trần Bình,</p>
                            <p>Nam Từ Liêm, Hà Nội</p>
                        </div>
                    </div>

                    <div class="contact-feature d-flex align-items-center my-lg-4 my-3">
                        <div class="contact-feature-icon tertiary-bg">
                            <i class="far fa-envelope fa-2x"></i>
                        </div>
                        <div class="contact-feature-text">
                            <h6>Email</h6>
                            <h5>Eduguard@gmail.com</h5>
                        </div>
                    </div>

                    <div class="contact-feature d-flex align-items-center">
                        <div class="contact-feature-icon success-bg">
                            <i class="fas fa-phone-alt fa-2x"></i>
                        </div>
                        <div class="contact-feature-text">
                            <h6>Điện thoại</h6>
                            <h5>0357-158-197</h5>
                        </div>
                    </div>
                    <img src="{{ asset('frontend/dist/images/shape/dots/dots-img-03.png') }}" alt="Hình dạng"
                        class="img-fluid contact-feature-shape" />
                </div>
                <div class="col-lg-7 form-area">
                    <form action="#">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label for="name">Họ và Tên</label>
                                <input type="text" class="form-control form-control--focused"
                                    placeholder="Nhập tại đây..." id="name" />
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="Nhập tại đây..." id="email" />
                            </div>
                        </div>
                        <div class="row my-lg-2 my-2">
                            <div class="col-12">
                                <label for="subject">Tiêu đề</label>
                                <input type="text" id="subject" class="form-control" placeholder="Nhập tại đây..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="message">Nội dung</label>
                                <textarea id="message" placeholder="Nhập tại đây..." class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-end">
                                <button type="submit" class="button button-lg button--primary fw-normal">Gửi Tin
                                    Nhắn</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-area-shape">
                        <img src="{{ asset('frontend/dist/images/shape/circle3.png') }}" alt="Hình dạng"
                            class="img-fluid shape-01" />
                        <img src="{{ asset('frontend/dist/images/shape/circle5.png') }}" alt="Hình dạng"
                            class="img-fluid shape-02" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Get in Touch Area Ends Here -->

    <!-- Map Area Starts Here -->
    <div class="map-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="map-area-frame">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.979421214179!2d105.82448231531803!3d21.028511293158594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9a0cda4f77%3A0x3c2d8b2c0d0c4c0b!2sHanoi%2C%20Vietnam!5e0!3m2!1sen!2s!4v1700100000000!5m2!1sen!2s"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Area Ends Here -->

@endsection
