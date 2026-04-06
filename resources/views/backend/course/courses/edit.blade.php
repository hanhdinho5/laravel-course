@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa khóa học')

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
                        <h4>Chỉnh sửa khóa học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('course.index') }}">Khóa học</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa khóa học</a></li>
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
                            @if (fullAccess())
                                <form action="{{ route('course.updateforAdmin', encryptor('encrypt', $course->id)) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $course->id) }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Trạng thái</label>
                                                <select class="form-control" name="status">
                                                    <option value="0" @if (old('status', $course->status) == 0) selected @endif>Chưa duyệt</option>
                                                    <option value="1" @if (old('status', $course->status) == 1) selected @endif>Tạm khóa</option>
                                                    <option value="2" @if (old('status', $course->status) == 2) selected @endif>Hoạt động</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Tiêu đề</label>
                                                <input type="text" class="form-control" name="courseTitle_en" value="{{ old('courseTitle_en', $course->title) }}">
                                            </div>
                                            @if ($errors->has('courseTitle_en'))
                                                <span class="text-danger">{{ $errors->first('courseTitle_en') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Mô tả</label>
                                                <textarea class="form-control" name="courseDescription_en">{{ old('courseDescription_en', $course->description_en) }}</textarea>
                                            </div>
                                            @if ($errors->has('courseDescription_en'))
                                                <span class="text-danger">{{ $errors->first('courseDescription_en') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Danh mục</label>
                                                <select class="form-control" name="categoryId">
                                                    @forelse ($courseCategory as $c)
                                                        <option value="{{ $c->id }}" {{ old('categoryId', $course->course_category_id) == $c->id ? 'selected' : '' }}>{{ $c->category_name }}</option>
                                                    @empty
                                                        <option value="">Không tìm thấy danh mục nào</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if ($errors->has('categoryId'))
                                                <span class="text-danger">{{ $errors->first('categoryId') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Giảng viên</label>
                                                <select class="form-control" name="instructorId">
                                                    @forelse ($instructor as $i)
                                                        <option value="{{ $i->id }}" {{ old('instructorId', $course->instructor_id) == $i->id ? 'selected' : '' }}>{{ $i->name_en }}</option>
                                                    @empty
                                                        <option value="">Không tìm thấy giảng viên nào</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if ($errors->has('instructorId'))
                                                <span class="text-danger">{{ $errors->first('instructorId') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Kiểu khóa học</label>
                                                <select class="form-control" name="courseType">
                                                    <option value="free" @if (old('courseType', $course->type) == 'free') selected @endif>Miễn phí</option>
                                                    <option value="paid" @if (old('courseType', $course->type) == 'paid') selected @endif>Trả phí</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('courseType'))
                                                <span class="text-danger">{{ $errors->first('courseType') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Trình độ</label>
                                                <select class="form-control" name="courseDifficulty">
                                                    <option value="beginner" @if (old('courseDifficulty', $course->difficulty) == 'beginner') selected @endif>Người mới bắt đầu</option>
                                                    <option value="intermediate" @if (old('courseDifficulty', $course->difficulty) == 'intermediate') selected @endif>Trung cấp</option>
                                                    <option value="advanced" @if (old('courseDifficulty', $course->difficulty) == 'advanced') selected @endif>Nâng cao</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('courseDifficulty'))
                                                <span class="text-danger">{{ $errors->first('courseDifficulty') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Giá</label>
                                                <input type="number" class="form-control" name="coursePrice" value="{{ old('coursePrice', $course->price) }}">
                                            </div>
                                            @if ($errors->has('coursePrice'))
                                                <span class="text-danger">{{ $errors->first('coursePrice') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Giá cũ</label>
                                                <input type="number" class="form-control" name="courseOldPrice" value="{{ old('courseOldPrice', $course->old_price) }}">
                                            </div>
                                            @if ($errors->has('courseOldPrice'))
                                                <span class="text-danger">{{ $errors->first('courseOldPrice') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Bắt đầu từ</label>
                                                <input type="date" class="form-control" name="start_from" value="{{ old('start_from', $course->start_from ? date('Y-m-d', strtotime($course->start_from)) : '') }}">
                                            </div>
                                            @if ($errors->has('start_from'))
                                                <span class="text-danger">{{ $errors->first('start_from') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Thời lượng</label>
                                                <input type="number" class="form-control" name="duration" value="{{ old('duration', $course->duration) }}">
                                            </div>
                                            @if ($errors->has('duration'))
                                                <span class="text-danger">{{ $errors->first('duration') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Số bài học</label>
                                                <input type="number" class="form-control" name="lesson" value="{{ old('lesson', $course->lesson) }}">
                                            </div>
                                            @if ($errors->has('lesson'))
                                                <span class="text-danger">{{ $errors->first('lesson') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Điều kiện tiên quyết</label>
                                                <textarea class="form-control" name="prerequisites_en">{{ old('prerequisites_en', $course->prerequisites_en) }}</textarea>
                                            </div>
                                            @if ($errors->has('prerequisites_en'))
                                                <span class="text-danger">{{ $errors->first('prerequisites_en') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Mã khóa học</label>
                                                <input type="text" class="form-control" name="course_code" value="{{ old('course_code', $course->course_code) }}">
                                            </div>
                                            @if ($errors->has('course_code'))
                                                <span class="text-danger">{{ $errors->first('course_code') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">URL video tổng quan</label>
                                                <input type="text" class="form-control" name="video" value="{{ old('video', $course->video) }}">
                                            </div>
                                            @if ($errors->has('video'))
                                                <span class="text-danger">{{ $errors->first('video') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Thẻ khóa học</label>
                                                <select class="form-control" name="tag">
                                                    <option value="popular" @if (old('tag', $course->tag) == 'popular') selected @endif>Phổ biến</option>
                                                    <option value="featured" @if (old('tag', $course->tag) == 'featured') selected @endif>Nổi bật</option>
                                                    <option value="upcoming" @if (old('tag', $course->tag) == 'upcoming') selected @endif>Sắp tới</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('tag'))
                                                <span class="text-danger">{{ $errors->first('tag') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-label">Hình ảnh</label>
                                            <div class="form-group fallback w-100">
                                                <input type="file" class="dropify" data-default-file="{{ $course->image ? asset('uploads/courses/' . $course->image) : '' }}" name="image">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <a href="{{ route('course.index') }}" class="btn btn-light">Hủy bỏ</a>
                                        </div>
                                    </div>
                                </form>
                            @endif
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