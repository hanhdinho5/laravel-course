@extends('backend.layouts.app')
@section('title', 'User Profile')


@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chào {{ encryptor('decrypt', request()->session()->get('userName')) }}! Mừng bạn trở lại!</h4>
                        <p class="mb-0">Mẫu bảng điều khiển của bạn</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile">
                        <div class="profile-head">
                            <div class="photo-content">
                                <div class="cover-photo"></div>

                            </div>
                            <div class="profile-info">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="profile-photo">
                                            <img src="{{ asset('uploads/users/' . request()->session()->get('image')) }}"
                                                class="rounded-circle" height="140" width="140" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-12">
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-6 border-right-1">
                                                <div class="profile-name">
                                                    <h4 class="text-primary mb-0">
                                                        {{ encryptor('decrypt', request()->session()->get('userName')) }}
                                                    </h4>
                                                    <p>{{ encryptor('decrypt', request()->session()->get('role')) }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-6 border-right-1">
                                                <div class="profile-email">
                                                    <h4 class="text-muted mb-0">
                                                        {{ encryptor('decrypt', request()->session()->get('emailAddress')) }}
                                                    </h4>
                                                    <p>Email</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="profile-blog pt-3 border-bottom-1 pb-1">
                                <h5 class="text-primary d-inline">Điểm nổi bật hôm nay</h5>
                                <a href="javascript:void()" class="pull-right f-s-16">Xem thêm</a>
                                <img src="{{ asset('images/profile/1.jpg') }}" alt=""
                                    class="img-fluid mt-4 mb-4 w-100">
                                <h4>Chủ đề Darwin Creative Agency</h4>
                                <p>Một con sông nhỏ tên là Duden chảy ngang qua nơi này và cung cấp cho nó những điều cần
                                    thiết.
                                    Đây là một vùng đất tuyệt đẹp, nơi những câu văn được nướng lên bay thẳng vào miệng bạn.
                                </p>
                            </div>

                            <div class="profile-interest mt-4 pb-2 border-bottom-1">
                                <h5 class="text-primary d-inline">Sở thích</h5>
                                <div class="row mt-4">
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/2.jpg') }}" alt="" class="img-fluid">
                                            <p>Trung tâm mua sắm</p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/3.jpg') }}" alt="" class="img-fluid">
                                            <p>Nhiếp ảnh</p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/4.jpg') }}" alt="" class="img-fluid">
                                            <p>Nghệ thuật &amp; Phòng trưng bày</p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/2.jpg') }}" alt="" class="img-fluid">
                                            <p>Địa điểm tham quan</p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/3.jpg') }}" alt=""
                                                class="img-fluid">
                                            <p>Mua sắm</p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                        <a href="javascript:void()" class="interest-cat">
                                            <img src="{{ asset('images/profile/4.jpg') }}" alt=""
                                                class="img-fluid">
                                            <p>Đạp xe</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-news mt-4 pb-3">
                                <h5 class="text-primary d-inline">Tin mới nhất của chúng tôi</h5>

                                <div class="media pt-3 pb-3">
                                    <img src="{{ asset('images/profile/5.jpg') }}" alt="image" class="mr-3">
                                    <div class="media-body">
                                        <h5 class="m-b-5">John Tomas</h5>
                                        <p>Tôi đã chia sẻ điều này lên tường Facebook của mình vài tháng trước và tôi muốn
                                            chia sẻ lại
                                            tại đây vì nó là một bài viết rất hay.</p>
                                    </div>
                                </div>

                                <div class="media pt-3 pb-3">
                                    <img src="{{ asset('images/profile/6.jpg') }}" alt="image" class="mr-3">
                                    <div class="media-body">
                                        <h5 class="m-b-5">John Tomas</h5>
                                        <p>Tôi đã chia sẻ điều này lên tường Facebook của mình vài tháng trước và tôi muốn
                                            chia sẻ lại
                                            tại đây vì nó là một bài viết rất hay.</p>
                                    </div>
                                </div>

                                <div class="media pt-3 pb-3">
                                    <img src="{{ asset('images/profile/7.jpg') }}" alt="image" class="mr-3">
                                    <div class="media-body">
                                        <h5 class="m-b-5">John Tomas</h5>
                                        <p>Tôi đã chia sẻ điều này lên tường Facebook của mình vài tháng trước và tôi muốn
                                            chia sẻ lại
                                            tại đây vì nó là một bài viết rất hay.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        {{-- <li class="nav-item"><a href="#my-posts" data-toggle="tab"
                                                class="nav-link active show">Bài viết</a>
                                        </li> --}}
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                                class="nav-link active show">Giới
                                                thiệu</a>
                                        </li>
                                        <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                                class="nav-link">Cài đặt thông tin</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="about-me" class="tab-pane fade active show">
                                            <div class="profile-about-me">
                                                <div class="pt-4 border-bottom-1 pb-4">
                                                    <h4 class="text-primary">Giới thiệu về tôi</h4>
                                                    <p>Một sự tĩnh lặng tuyệt vời đã chiếm trọn tâm hồn tôi, giống như những
                                                        buổi sáng ngọt ngào của mùa xuân mà tôi tận hưởng bằng cả trái tim.
                                                        Tôi ở một mình, và cảm nhận được sức hấp dẫn của sự tồn tại dường
                                                        như được tạo ra cho niềm hạnh phúc của những tâm hồn như tôi.
                                                        Tôi rất hạnh phúc, bạn thân mến, bị cuốn vào cảm giác tuyệt vời của
                                                        sự tồn tại yên bình đến mức tôi quên cả những tài năng của mình.</p>
                                                    <p>Một bộ sưu tập các mẫu vải được bày ra trên bàn — Samsa là một nhân
                                                        viên bán hàng lưu động — và phía trên nó treo một bức tranh mà anh
                                                        ấy vừa cắt ra từ một tạp chí minh họa và đóng khung rất đẹp.</p>
                                                </div>
                                            </div>

                                            <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                                <h4 class="text-primary mb-4">Kỹ năng</h4>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Quản
                                                    trị</a>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Bảng
                                                    điều khiển</a>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Photoshop</a>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Bootstrap</a>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Responsive</a>
                                                <a href="javascript:void()"
                                                    class="btn btn-outline-dark btn-rounded px-4 my-3 my-sm-0 mr-2 mb-1 m-b-10">Tiền
                                                    điện tử</a>
                                            </div>

                                            <div class="profile-lang pt-5 border-bottom-1 pb-5">
                                                <h4 class="text-primary mb-4">Ngôn ngữ</h4>
                                                <a href="javascript:void()" class="text-muted pr-3 f-s-16">
                                                    <i class="flag-icon flag-icon-us"></i> Tiếng Anh
                                                </a>
                                                <a href="javascript:void()" class="text-muted pr-3 f-s-16">
                                                    <i class="flag-icon flag-icon-fr"></i> Tiếng Pháp
                                                </a>
                                                <a href="javascript:void()" class="text-muted pr-3 f-s-16">
                                                    <i class="flag-icon flag-icon-bd"></i> Tiếng Bengal
                                                </a>
                                            </div>

                                            <div class="profile-personal-info">
                                                <h4 class="text-primary mb-4">Thông tin cá nhân</h4>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Họ và tên <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-9"><span>Mitchell C.Shay</span></div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Email <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-9"><span>example@examplel.com</span></div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Khả dụng <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-9"><span>Toàn thời gian (Freelancer)</span></div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Tuổi <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-9"><span>27</span></div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Địa chỉ <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-9"><span>Rosemont Avenue, Melbourne, Florida</span>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">Kinh nghiệm <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-9"><span>07 năm kinh nghiệm</span></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="profile-settings" class="tab-pane fade">
                                            <div class="pt-3">
                                                <div class="settings-form">
                                                    <h4 class="text-primary">Cài đặt tài khoản</h4>
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Email</label>
                                                                <input type="email" placeholder="Email"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Mật khẩu</label>
                                                                <input type="password" placeholder="Mật khẩu"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Địa chỉ</label>
                                                            <input type="text" placeholder="Hà Nội"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Địa chỉ cụ thể</label>
                                                            <input type="text" placeholder="Cầu Giấy"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Thành phố</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Hà Nội">
                                                            </div>
                                                            {{-- <div class="form-group col-md-4">
                                                                <label>State</label>
                                                                <select class="form-control" id="inputState">
                                                                    <option selected="">Choose...</option>
                                                                    <option>Option 1</option>
                                                                    <option>Option 2</option>
                                                                    <option>Option 3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>Zip</label>
                                                                <input type="text" class="form-control">
                                                            </div> --}}
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="gridCheck">
                                                                <label class="custom-control-label" for="gridCheck"> Hãy
                                                                    xem tôi nhé</label>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
@endpush
