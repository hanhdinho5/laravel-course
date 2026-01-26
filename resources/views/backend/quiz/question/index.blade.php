@extends('backend.layouts.app')
@section('title', 'Danh sách câu hỏi')

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
                        <h4><strong class="p-3 mb-2 bg-info-subtle text-info-emphasis">{{ $quiz->title }}</strong></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('quiz.index') }}">Bài kiểm tra</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('quiz.question.index', encryptor('encrypt', $quiz->id)) }}">Tất cả câu
                                hỏi</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">Hiển thị dạng danh sách</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-flex align-items-center gap-2">
                                        <i class="bi bi-question-circle text-info"></i>
                                        <span>Danh sách câu hỏi trong</span>
                                        <span class="badge bg-info text-dark px-3 ml-2 py-2 fs-6">{{ $quiz->title }}</span>
                                    </h4>
                                    <a href="{{ route('quiz.question.create', encryptor('encrypt', $quiz->id)) }}"
                                        class="btn btn-primary">+ Thêm câu hỏi</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Dạng câu hỏi') }}</th>
                                                    <th>{{ __('Câu hỏi') }}</th>
                                                    <th>{{ __('Đáp án A') }}</th>
                                                    <th>{{ __('Đáp án B') }}</th>
                                                    <th>{{ __('Đáp án C') }}</th>
                                                    <th>{{ __('Đáp án D') }}</th>
                                                    <th>{{ __('Đáp án đúng') }}</th>
                                                    <th>{{ __('Hành động') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($question as $q)
                                                    <tr>
                                                        {{-- <td>{{ $q->quiz?->title }}</td> --}}
                                                        <td>
                                                            {{ $q->type == 'multiple_choice'
                                                                ? __('Trắc nghiệm')
                                                                : ($q->type == 'true_false'
                                                                    ? __('True False')
                                                                    : __('Short Answer')) }}
                                                        </td>
                                                        <td>{{ $q->content }}</td>
                                                        <td>{{ $q->option_a }}</td>
                                                        <td>{{ $q->option_b }}</td>
                                                        <td>{{ $q->option_c }}</td>
                                                        <td>{{ $q->option_d }}</td>
                                                        <td>
                                                            {!! $q->correct_answer == 'a'
                                                                ? '<button type="button" class="btn btn-info">A</button>'
                                                                : ($q->correct_answer == 'b'
                                                                    ? '<button type="button" class="btn btn-info">B</button>'
                                                                    : ($q->correct_answer == 'c'
                                                                        ? '<button type="button" class="btn btn-info">C</button>'
                                                                        : '<button type="button" class="btn btn-info">D</button>')) !!}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('quiz.question.edit', [encryptor('encrypt', $quiz->id), encryptor('encrypt', $q->id)]) }}"
                                                                class="btn btn-sm btn-primary" title="Sửa"><i
                                                                    class="la la-pencil"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                                title="Xoá"
                                                                onclick="$('#form{{ $q->id }}').submit()"><i
                                                                    class="la la-trash-o"></i></a>
                                                            <form id="form{{ $q->id }}"
                                                                action="{{ route('quiz.question.destroy', [encryptor('encrypt', $quiz->id), encryptor('encrypt', $q->id)]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="5" class="text-center">Không tồn tại câu hỏi nào
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
