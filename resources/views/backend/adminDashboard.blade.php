@extends('backend.layouts.app')
@section('title', 'Admin Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin-2.css') }}">
@endpush

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-primary overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title text-white">Tổng học viên</h3>
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $totalStudents }}</h5>
                        </div>
                        <div class="card-body text-center mt-3">
                            <div class="ico-sparkline">
                                <div id="sparkline12"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-success overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title text-white">Học viên mới</h3>
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $totalEnrollments }}</h5>
                        </div>
                        <div class="card-body text-center mt-4 p-0">
                            <div class="ico-sparkline">
                                <div id="spark-bar-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-secondary overflow-hidden">
                        <div class="card-header pb-3">
                            <h3 class="card-title text-white">Tổng khoá học</h3>
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> {{ $totalCourses }}</h5>
                        </div>
                        <div class="card-body p-0 mt-2">
                            <div class="px-4"><span class="bar1"
                                    data-peity='{ "fill": ["rgb(0, 0, 128)", "rgb(7, 135, 234)"]}'>6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="widget-stat card bg-danger overflow-hidden">
                        <div class="card-header pb-3">
                            <h3 class="card-title text-white">Thu phí</h3>
                            <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i>
                                {{ number_format($totalTuitionFee, 0, ',', '.') }} VNĐ </h5>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <span class="peity-line-2" data-width="100%">7,6,8,7,3,8,3,3,6,5,9,2,8</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Báo cáo Thu nhập/Chi phí</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart_2"></canvas>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Báo cáo Thu nhập/Chi phí</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="areaChart_1"></canvas>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách tuyển sinh mới</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th class="px-5 py-3">Họ tên</th>
                                            <th class="py-3">Khoá học</th>
                                            <th class="py-3">Giảng viên</th>
                                            <th class="py-3">Trạng thái</th>
                                            <th class="py-3">Ngày nhập học</th>
                                            {{-- <th class="py-3">Sửa đổi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="customers">
                                        @forelse ($enrollments as $enrollment)
                                            <tr class="btn-reveal-trigger">
                                                <td class="p-3">
                                                    <a href="javascript:void(0);">
                                                        <div class="media d-flex align-items-center">
                                                            <div class="avatar avatar-xl mr-2">
                                                                <img src="{{ $enrollment->student?->image ? asset('uploads/students/' . $enrollment->student?->image) : asset('uploads/students/avatar.png') }}"
                                                                    alt=""
                                                                    style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="mb-0 fs--1">{{ $enrollment->student?->name_en }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="py-2">{{ $enrollment->course?->title }}</td>
                                                <td class="py-2">{{ $enrollment->course?->instructor?->name_en }}</td>
                                                <td>
                                                    @if ($enrollment->status == '1')
                                                        <span class="badge badge-rounded badge-success">Đã thanh toán</span>
                                                    @else
                                                        <span class="badge badge-rounded badge-warning">Chờ thanh
                                                            toán</span>
                                                    @endif
                                                </td>
                                                <td class="py-2">
                                                    {{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}
                                                </td>
                                                {{-- <td>
                                                    <a href="edit-student.html" class="btn btn-sm btn-primary"><i
                                                            class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i
                                                            class="la la-trash-o"></i></a>
                                                </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Không có học viên mới nào</td>
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

@endsection

@push('scripts')
    <!-- Chart ChartJS plugin files -->
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Chart sparkline plugin files -->
    <script src="{{ asset('vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script>
        window.dashboardBarChart = {
            labels: @json($monthlyRevenueLabels),
            data: @json($monthlyRevenueData),
        };
    </script>

    <!-- Demo scripts -->
    <script src="{{ asset('js/dashboard/dashboard-3.js') }}"></script>
@endpush
