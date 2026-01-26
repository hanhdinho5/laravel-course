<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ ENV('APP_NAME') }} | @yield('title')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')

</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('home') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/logo-white.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/d-logo.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/d-logo.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <style>
            .user-menu {
                display: flex;
                align-items: center;
                gap: 10px;
                /* khoảng cách giữa tên và avatar */
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .user-menu li {
                display: flex;
                align-items: center;
            }

            .username {
                font-weight: 500;
                white-space: nowrap;
            }
        </style>
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Tìm kiếm"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="user-menu">
                            <li class="username">
                                {{ encryptor('decrypt', request()->session()->get('userName')) }}
                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" title="Profile Info" href="#" role="button"
                                    data-toggle="dropdown">
                                    <img src="{{ asset('uploads/users/' . (request()->session()->get('image') ?? 'avatar.png')) }}"
                                        width="32" height="32" class="rounded-circle" alt="">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('userProfile') }}" class="dropdown-item ai-icon">
                                        <span class="ml-2">Hồ sơ</span>
                                    </a>

                                    <a href="{{ route('logOut') }}" class="dropdown-item ai-icon">
                                        <span class="ml-2">Đăng xuất</span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Quản trị viên</li>
                    <li><a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="las la-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a class="ai-icon" href="{{ route('home') }}" aria-expanded="false">
                            <i class="las la-home"></i>
                            <span class="nav-text">Trang chủ</span>
                        </a>
                    </li>
                    <li class="nav-label">Menu chính</li>
                    {{-- @php dd (checkAuth()) @endphp --}}
                    @if (!isInstructor())
                        <li><a class="" href="{{ route('role.index') }}" aria-expanded="false">
                                <i class="las la-cog"></i>
                                <span class="nav-text">Nhóm quyền</span>
                            </a>
                        </li>
                    @endif


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-universal-access"></i>
                            <span class="nav-text">Vai trò</span>
                        </a>
                        <ul aria-expanded="false">
                            @if (!isInstructor())
                                <li><a href="{{ route('user.index') }}"><i class="la la-users"></i>Nhân
                                        viên</a>
                                </li>
                            @endif

                            <li><a href="{{ route('instructor.index') }}"><i
                                        class="las la-chalkboard-teacher"></i>Giảng viên</a>
                            </li>
                            <li><a href="{{ route('student.index') }}"><i class="las la-book-reader"></i>Học
                                    viên</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-school"></i>
                            <span class="nav-text">Khóa học</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('courseCategory.index') }}"><i class="la la-list"></i>Danh
                                    mục</a>
                            </li>
                            @if (!isInstructor())
                                <li><a href="{{ route('courseList') }}"><i class="las la-school"></i>Danh
                                        sách</a>
                                </li>
                            @else
                                <li><a href="{{ route('my.courseList') }}"><i class="las la-school"></i>Khoá học của
                                        tôi</a>
                                </li>
                            @endif

                            <li><a href="{{ route('lesson.index') }}"><i class="las la-chalkboard"></i>Bài
                                    học</a></li>
                            <li><a href="{{ route('material.index') }}"><i class="las la-atom"></i></i>Tài
                                    liệu</a></li>
                            <li><a href="{{ route('quiz.index') }}"><i class="las la-book-open"></i>Bài kiểm
                                    tra</a></li>
                        </ul>
                    </li>
                    <li><a class="" href="{{ route('enrollment.index') }}" aria-expanded="false">
                            <i class="las la-bullseye"></i>
                            <span class="nav-text">Tuyển sinh</span>
                        </a>
                    </li>
                    <li><a class="" href="{{ route('event.index') }}" aria-expanded="false">
                            <i class="las la-icons"></i>
                            <span class="nav-text">Sự kiện</span>
                        </a>
                    </li>
                    {{-- <li><a class="" href="{{ route('coupon.index') }}" aria-expanded="false">
                            <i class="las la-tags"></i>
                            <span class="nav-text">Giảm giá</span>
                        </a>
                    </li> --}}
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-tasks"></i>
                            <span class="nav-text">Quizzes</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('quiz.index')}}"><i class="las la-icons"></i>All Quizzes</a></li>
                            <li><a href="{{route('question.index')}}"><i
                                        class="las la-question-circle"></i>Questions</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-star-half-alt"></i>
                            <span class="nav-text">Reviews</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('review.index')}}"><i class="las la-wave-square"></i>All Review</a>
                            </li>
                            <li><a href="{{route('review.index')}}"><i class="las la-star"></i>Ratings</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-comment"></i>
                            <span class="nav-text">Forum</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('discussion.index')}}"><i class="las la-comment-alt"></i>Discussion</a>
                            </li>
                            <li><a href="{{route('message.index')}}"><i class="las la-envelope"></i>Messages</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-money-check"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="javascript:void()"><i class="las la-money-bill"></i>Course Fees</a></li>
                            <li><a href="javascript:void()"><i class="lab la-gg-circle"></i>Subscription Fees</a></li>
                            <li><a href="{{route('coupon.index')}}"><i class="las la-tags"></i>Coupons</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>

        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->

        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2020
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>

    <!-- Svganimation scripts -->
    <script src="{{ asset('vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ asset('vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    @stack('scripts')
    {{-- TOASTER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    {!! Toastr::message() !!}
</body>

</html>
