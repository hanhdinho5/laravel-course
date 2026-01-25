@extends('backend.layouts.app')
@section('title', 'Enrollment List')

@push('styles')
    <!-- Datatable -->
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tuyển sinh</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('enrollment.index') }}">Tuyển sinh</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('enrollment.index') }}">Tất cả tuyển sinh</a>
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
                                    <h4 class="card-title">DANH SÁCH TẤT CẢ ĐƠN ĐĂNG KÍ </h4>
                                    <a href="{{ route('enrollment.create') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Tên học sinh') }}</th>
                                                    <th>{{ __('Tên khóa học') }}</th>
                                                    <th>{{ __('Hình ảnh khóa học') }}</th>
                                                    <th>{{ __('Giá trị khóa học') }}</th>
                                                    <th>{{ __('Ngày nhập học') }}</th>
                                                    <th>{{ __('Hoạt động') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($enrollment as $e)
                                                    <tr>
                                                        <td><img class="rounded-circle" width="35" height="35"
                                                                src="{{ asset('uploads/students/' . ($e->student?->image ?? 'avatar.png')) }}"
                                                                alt="">
                                                        </td>
                                                        <td><strong>{{ $e->student?->name_en }}</strong></td>
                                                        <td><strong>{{ $e->course?->title }}</strong></td>
                                                        <td><img class="img fluid" width="100"
                                                                src="{{ asset('uploads/courses/' . $e->course?->image) }}"
                                                                alt="">
                                                        </td>
                                                        <td><strong>{{ $e->course?->price == null ? 'Free' : $e->course?->price . ' VNĐ' }}</strong>
                                                        </td>
                                                        <td><strong>{{ $e->enrollment_date }}</strong></td>
                                                        <td>
                                                            @if ($e->status == '0')
                                                                <button type="button"
                                                                    class="btn btn-warning openConfirmModal"
                                                                    data-id="{{ $e->id }}" style="min-width:160px"
                                                                    data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                                    Đang chờ kích hoạt
                                                                </button>
                                                            @else
                                                                <button type="button"
                                                                    style="min-width:160px; pointer-events:none; cursor:default; background-color:#20cc7c; border-color:#198754;"
                                                                    class="btn btn-success">
                                                                    Đã kích hoạt
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="6" class="text-center">Không tìm thấy đăng kí</th>
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
    <!-- Modal xác nhận duyệt khoá học-->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Xác nhận hành động</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    Bạn có chắc chắn muốn kích hoạt khóa học cho học viên này không?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success" id="confirmActivate">Xác nhận</button>
                </div>

            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

    <script>
        let selectedId = null;

        // Khi bấm vào nút trong foreach -> lưu lại id
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('openConfirmModal')) {
                selectedId = event.target.getAttribute('data-id');
                console.log('Selected ID:', selectedId);
            }
        });

        // Khi bấm nút "Xác nhận"
        document.getElementById('confirmActivate').addEventListener('click', async function() {
            if (!selectedId) return;

            try {
                const response = await fetch(`/admin/activate-course/${selectedId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (!response.ok) throw new Error('Request failed');

                $('#confirmModal').modal('hide');
                location.reload();

            } catch (error) {
                console.error(error);
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    </script>
@endpush
