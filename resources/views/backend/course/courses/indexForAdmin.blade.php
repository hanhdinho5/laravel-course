@extends('backend.layouts.app')
@section('title', 'Course List')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách khóa học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('course.index') }}">Giảng viên</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('course.index') }}">Tất cả các khóa học</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách tất cả các khóa học </h4>
                                    <a href="{{ route('course.create') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên khóa học</th>
                                                    <th>Người hướng dẫn</th>
                                                    <th>Loại</th>
                                                    <th>Giá</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hoạt động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($course as $d)
                                                    <tr>
                                                        <td><img class="img fluid" width="100"
                                                                src="{{ asset('uploads/courses/' . $d->image) }}"
                                                                alt="">
                                                        </td>
                                                        <td><strong>{{ $d->title }}</strong></td>
                                                        <td><strong>{{ $d->instructor?->name_en }}</strong></td>
                                                        <td><strong>{{ $d->courseCategory?->category_name }}</strong>
                                                        </td>
                                                        <td><strong>{{ $d->price ? $d->price . ' VNĐ' : 'Free' }}</strong>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge
                                                    @if ($d->status == 2) badge-success
                                                    @else badge-danger @endif">
                                                                @if ($d->status == 2)
                                                                    {{ __('Hoạt động') }}
                                                                @else
                                                                    {{ __('Tạm khoá') }}
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('course.edit', encryptor('encrypt', $d->id)) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa"><i
                                                                    class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                title="Xoá"
                                                                onclick="$('#form{{ $d->id }}').submit()"><i
                                                                    class="la la-trash-o"></i></a>
                                                            <form id="form{{ $d->id }}"
                                                                action="{{ route('course.destroy', encryptor('encrypt', $d->id)) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="6" class="text-center">No Enrollment Found</th>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
@endpush
