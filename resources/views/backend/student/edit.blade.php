@extends('backend.layouts.app')
@section('title', 'Edit Student')

@push('styles')
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.date.css') }}">
@endpush

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chỉnh sửa học sinh</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student.index') }}">Học sinh</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa học sinh</a></li>
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
                            <form action="{{ route('student.update', encryptor('encrypt', $student->id)) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $student->id) }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Tên</label>
                                            <input type="text" class="form-control" name="fullName_en"
                                                value="{{ old('fullName_en', $student->name_en) }}">
                                        </div>
                                        @if ($errors->has('fullName_en'))
                                            <span class="text-danger"> {{ $errors->first('fullName_en') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Số điện thoại</label>
                                            <input type="tel" class="form-control" name="contactNumber_en"
                                                value="{{ old('contactNumber_en', $student->contact_en) }}">
                                        </div>
                                        @if ($errors->has('contactNumber_en'))
                                            <span class="text-danger"> {{ $errors->first('contactNumber_en') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="emailAddress"
                                                value="{{ old('emailAddress', $student->email) }}">
                                        </div>
                                        @if ($errors->has('emailAddress'))
                                            <span class="text-danger"> {{ $errors->first('emailAddress') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Vai trò</label>
                                            <select class="form-control" name="roleId">
                                                @forelse ($role as $r)
                                                    <option value="{{ $r->id }}"
                                                        {{ old('roleId', $student->role_id) == $r->id ? 'selected' : '' }}>
                                                        {{ $r->name }}</option>
                                                @empty
                                                    <option value="">Không tìm thấy vai trò</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if ($errors->has('roleId'))
                                            <span class="text-danger"> {{ $errors->first('roleId') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Ngày tháng năm sinh</label>
                                            <input type="date" name="birthDate"
                                                value="{{ old('birthDate', $student->date_of_birth) }}"
                                                class="form-control" id="">
                                        </div>
                                        @if ($errors->has('birthDate'))
                                            <span class="text-danger"> {{ $errors->first('birthDate') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Giới tính</label>
                                            <select class="form-control" name="gender">
                                                <option value="male" @if (old('gender', $student->gender) == 'male') selected @endif>Nam
                                                </option>
                                                <option value="female" @if (old('gender', $student->gender) == 'female') selected @endif>Nữ
                                                </option>
                                                <option value="other" @if (old('gender', $student->gender) == 'other') selected @endif>
                                                    Khác
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if (old('status', $student->status) == 1) selected @endif>
                                                    Tích cực</option>
                                                <option value="0" @if (old('status', $student->status) == 0) selected @endif>
                                                    Không hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-danger"> {{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-label">Hình ảnh</label>
                                        <div class="form-group fallback w-100">
                                            <input type="file" class="dropify" data-default-file="" name="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <button type="submit" class="btn btn-light">Hủy bỏ</button>
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
    <!-- pickdate -->
    <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>

    <!-- Pickdate -->
    <script src="{{ asset('js/plugins-init/pickadate-init.js') }}"></script>
@endpush
