@extends('backend.layouts.app')
@section('title', 'User List')

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
                        <h4>Danh sách người dùng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Người dùng</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">Tất cả người dùng</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">Chế độ xem danh sách</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Chế độ xem
                                lưới</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách tất cả học sinh </h4>
                                    <a href="{{ route('user.create') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Tên') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Liên hệ') }}</th>
                                                    <th>{{ __('Vai trò') }}</th>
                                                    {{-- <th>{{ __('Truy cập đầy đủ') }}</th> --}}
                                                    <th>{{ __('Trạng thái') }}</th>
                                                    <th>{{ __('Hoạt động') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $d)
                                                    <tr>
                                                        <td><img class="rounded-circle" width="35" height="35"
                                                                src="{{ asset('uploads/users/' . ($d->image ?? 'avatar.png')) }}"
                                                                alt=""></td>
                                                        <td><strong>{{ $d->name_en }}</strong></td>
                                                        <td>{{ $d->email }}</td>
                                                        <td>{{ $d->contact_en }}</td>
                                                        <td>{{ $d->role?->name }}</td>
                                                        {{-- <td>
                                                            <span
                                                                class="badge {{ $d->full_access == 1
                                                                    ? "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        badge-info"
                                                                    : 'badge-warning' }}">
                                                                @if ($d->full_access == 1)
                                                                    {{ __('Yes') }}
                                                                    @else{{ __('No') }}
                                                                @endif
                                                            </span>
                                                        </td> --}}
                                                        <td>
                                                            <span
                                                                class="badge {{ $d->status == 1
                                                                    ? "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        badge-success"
                                                                    : 'badge-danger' }}">
                                                                @if ($d->status == 1)
                                                                    {{ __('Hoạt động') }}
                                                                    @else{{ __('Tạm khoá') }}
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('user.edit', encryptor('encrypt', $d->id)) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa"><i
                                                                    class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                title="Xoá"
                                                                onclick="$('#form{{ $d->id }}').submit()"><i
                                                                    class="la la-trash-o"></i></a>
                                                            <form id="form{{ $d->id }}"
                                                                action="{{ route('user.destroy', encryptor('encrypt', $d->id)) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="7" class="text-center">Không tìm thấy người dùng
                                                        </th>
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
