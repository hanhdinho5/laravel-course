@extends('backend.layouts.app')
@section('title', 'Kiểm tra')

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
                        <h4>Danh sách bài kiểm tra</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('quiz.index') }}">Bài kiểm </a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('quiz.index') }}">Tất cả bài kiểm tra</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">Hiển thị dạng danh sách</a></li>
                        {{-- <li class="nav-item"><a href="javascript:void(0);" data-toggle="tab"
                                class="nav-link btn-primary">Grid
                                View</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách kiểm tra </h4>
                                    <a href="{{ route('quiz.create') }}" class="btn btn-primary">+ Bài kiểm tra</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Tên bài kiểm tra') }}</th>
                                                    <th>{{ __('Khoá học') }}</th>
                                                    <th>{{ __('Hành động') }}</th>
                                                    <th>{{ __('Xem câu hỏi') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($quiz as $q)
                                                    <tr>
                                                        <td>{{ $q->id }}</td>
                                                        <td>{{ $q->title }}</td>
                                                        <td>{{ $q->course?->title }}</td>
                                                        <td>
                                                            <a href="{{ route('quiz.edit', encryptor('encrypt', $q->id)) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa"><i
                                                                    class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                title="Xoá"
                                                                onclick="$('#form{{ $q->id }}').submit()"><i
                                                                    class="la la-trash-o"></i></a>
                                                            <form id="form{{ $q->id }}"
                                                                action="{{ route('quiz.destroy', encryptor('encrypt', $q->id)) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('quiz.question.index', encryptor('encrypt', $q->id)) }}"
                                                                class="btn btn-outline-info" title="Xem câu hỏi"><i
                                                                    class="la la-eye px-2"></i>

                                                            </a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="4" class="text-center">Không tồn tại bài kiểm tra
                                                            nào</th>
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
