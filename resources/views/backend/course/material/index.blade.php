@extends('backend.layouts.app')
@section('title', 'Danh sách tài liệu')

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
                        <h4>Danh sách tài liệu</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('material.index') }}">Tất cả tài liệu</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">Danh sách</a></li>

                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tất cả tài liệu</h4>
                                    <a href="{{ route('material.create') }}" class="btn btn-primary">+ Thêm tài liệu</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>Tên tài liệu</th>
                                                    <th>Bài học</th>
                                                    <th>Loại</th>
                                                    <th>Nội dung</th>
                                                    <th>Đường dẫn</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($material as $m)
                                                    <tr>
                                                        <td>{{ $m->id }}</td>
                                                        <td>{{ $m->title }}</td>
                                                        <td>{{ $m->lesson?->title }}</td>
                                                        <td>
                                                            {{ $m->type == 'video' ? __('Video') : ($m->type == 'document' ? __('Tài liệu') : __('Quiz')) }}
                                                        </td>
                                                        @php
                                                            $ext = strtolower(
                                                                pathinfo($m->content, PATHINFO_EXTENSION),
                                                            );
                                                            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);
                                                        @endphp

                                                        <td>
                                                            @if ($isVideo)
                                                                <video width="200" height="100" controls
                                                                    preload="metadata">
                                                                    <source
                                                                        src="{{ asset('uploads/courses/contents/' . $m->content) }}"
                                                                        type="video/{{ $ext }}">
                                                                    Trình duyệt không hỗ trợ video
                                                                </video>
                                                            @else
                                                                <embed
                                                                    src="{{ asset('uploads/courses/contents/' . $m->content) }}"
                                                                    width="200" height="100" />
                                                            @endif
                                                        </td>
                                                        <td>{{ $m->content_url }}</td>
                                                        <td>
                                                            <a href="{{ route('material.edit', encryptor('encrypt', $m->id)) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa"><i
                                                                    class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                title="Xoá"
                                                                onclick="$('#form{{ $m->id }}').submit()"><i
                                                                    class="la la-trash-o"></i></a>
                                                            <form id="form{{ $m->id }}"
                                                                action="{{ route('material.destroy', encryptor('encrypt', $m->id)) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="6" class="text-center">No Course Material Found</th>
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
