@extends('backend.layouts.app')
@section('title', 'Giảng viên')

@push('styles')
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách giảng viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('instructor.index') }}">Giảng viên</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('instructor.index') }}">Tất cả giảng viên</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">Xem dạng danh sách</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách giảng viên</h4>
                                    <a href="{{ route('instructor.create') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Điện thoại</th>
                                                    <th>Vị trí công việc</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($instructor as $d)
                                                    <tr>
                                                        <td><img class="rounded-circle" width="40" height="40" src="{{ asset($d->image ? 'uploads/users/' . $d->image : 'images/avatar/1.png') }}" alt="{{ $d->name_en }}"></td>
                                                        <td><strong>{{ $d->name_en }}</strong></td>
                                                        <td>{{ $d->email }}</td>
                                                        <td>{{ $d->contact_en }}</td>
                                                        <td>{{ $d->designation }}</td>
                                                        <td>
                                                            <span class="badge {{ $d->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $d->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('instructor.edit', encryptor('encrypt', $d->id)) }}" class="btn btn-sm btn-primary" title="Sửa"><i class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" title="Xóa" onclick="$('#form{{ $d->id }}').submit()"><i class="la la-trash-o"></i></a>
                                                            <form id="form{{ $d->id }}" action="{{ route('instructor.destroy', encryptor('encrypt', $d->id)) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="7" class="text-center">Không tìm thấy giảng viên</th>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="grid-view" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @forelse ($instructor as $d)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile">
                                            <div class="card-header justify-content-end pb-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                        <span class="dropdown-dots fs--1"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                                        <div class="py-2">
                                                            <a class="dropdown-item" href="{{ route('instructor.edit', encryptor('encrypt', $d->id)) }}">Chỉnh sửa</a>
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="text-center">
                                                    <div class="profile-photo">
                                                        <img src="{{ asset($d->image ? 'uploads/users/' . $d->image : 'images/avatar/1.png') }}" width="100" height="100" class="rounded-circle" alt="{{ $d->name_en }}">
                                                    </div>
                                                    <h3 class="mt-4 mb-1">{{ $d->name_en }}</h3>
                                                    <p class="text-muted">{{ $d->role?->name }}</p>
                                                    <ul class="list-group mb-3 list-group-flush">
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Điện thoại:</span>
                                                            <strong>{{ $d->contact_en }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Email:</span>
                                                            <strong>{{ $d->email }}</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                                            <span>Trạng thái:</span>
                                                            <span class="badge {{ $d->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $d->status == 1 ? 'Hoạt động' : 'Khóa' }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile">
                                            <div class="card-body pt-2">
                                                <div class="text-center">
                                                    <p class="mt-3 px-4">Không tìm thấy giảng viên</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
@endpush