@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa giảng viên')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.date.css') }}">
@endpush

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chỉnh sửa giảng viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('instructor.index') }}">Giảng viên</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa giảng viên</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin cơ bản</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('instructor.update', encryptor('encrypt', $instructor->id)) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $instructor->id) }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Họ tên</label>
                                            <input type="text" class="form-control" name="fullName_en" value="{{ old('fullName_en', $instructor->name_en) }}">
                                        </div>
                                        @if ($errors->has('fullName_en'))
                                            <span class="text-danger">{{ $errors->first('fullName_en') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Điện thoại</label>
                                            <input type="tel" class="form-control" name="contactNumber_en" value="{{ old('contactNumber_en', $instructor->contact_en) }}">
                                        </div>
                                        @if ($errors->has('contactNumber_en'))
                                            <span class="text-danger">{{ $errors->first('contactNumber_en') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="emailAddress" value="{{ old('emailAddress', $instructor->email) }}">
                                        </div>
                                        @if ($errors->has('emailAddress'))
                                            <span class="text-danger">{{ $errors->first('emailAddress') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Vai trò</label>
                                            <select class="form-control" disabled>
                                                <option value="instructor">Giảng viên</option>
                                            </select>
                                            <input type="hidden" name="roleId" value="3">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Vị trí công việc</label>
                                            <input type="text" class="form-control" name="designation" value="{{ old('designation', $instructor->designation) }}">
                                        </div>
                                        @if ($errors->has('designation'))
                                            <span class="text-danger">{{ $errors->first('designation') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Cấp bậc nghề nghiệp</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title', $instructor->title) }}">
                                        </div>
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if (old('status', $instructor->status) == 1) selected @endif>Hoạt động</option>
                                                <option value="0" @if (old('status', $instructor->status) == 0) selected @endif>Tạm khóa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mật khẩu (để trống nếu không thay đổi)</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Tiểu sử</label>
                                            <textarea class="form-control" name="bio">{{ old('bio', $instructor->bio) }}</textarea>
                                        </div>
                                        @if ($errors->has('bio'))
                                            <span class="text-danger">{{ $errors->first('bio') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-label">Ảnh</label>
                                        <div class="form-group fallback w-100">
                                            <input type="file" class="dropify" data-default-file="{{ asset($instructor->image ? 'uploads/users/' . $instructor->image : 'images/avatar/1.png') }}" name="image">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary mr-3">Cập nhật</button>
                                        <a href="{{ route('instructor.index') }}" class="btn btn-light">Quay lại</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('js/plugins-init/pickadate-init.js') }}"></script>
@endpush