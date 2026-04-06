@extends('frontend.layouts.app')
@section('title', 'Courses')
@section('body-attr') style="background-color: #ebebf2;" @endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/src/scss/vendors/plugin/css/jquery-ui.css') }}" />
    <style>
        .search-course-pagination {
            margin-top: 2rem;
        }

        .search-course-pagination .pagination {
            --page-accent: #f26a2e;
            --page-accent-soft: #fff2ea;
            --page-border: #eadfd8;
            --page-text: #372d2a;
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .search-course-pagination .page-item {
            list-style: none;
        }

        .search-course-pagination .page-link,
        .search-course-pagination .page-item span {
            min-width: 46px;
            height: 46px;
            padding: 0 1rem;
            border-radius: 999px;
            border: 1px solid var(--page-border);
            background: #fff;
            color: var(--page-text);
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 44px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 10px 24px rgba(33, 18, 11, 0.06);
        }

        .search-course-pagination .page-link:hover {
            background: var(--page-accent-soft);
            border-color: rgba(242, 106, 46, 0.35);
            color: var(--page-accent);
            transform: translateY(-1px);
        }

        .search-course-pagination .page-item.active .page-link,
        .search-course-pagination .page-item.active span {
            background: linear-gradient(135deg, #f26a2e, #ff8b54);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 14px 30px rgba(242, 106, 46, 0.28);
        }

        .search-course-pagination .page-item.disabled span,
        .search-course-pagination .page-item.disabled .page-link {
            background: #f6f3f1;
            border-color: #eee5df;
            color: #b0a39b;
            box-shadow: none;
            cursor: not-allowed;
        }

        .search-course-pagination .page-item:first-child .page-link,
        .search-course-pagination .page-item:last-child .page-link,
        .search-course-pagination .page-item:first-child span,
        .search-course-pagination .page-item:last-child span {
            min-width: 96px;
        }

        @media (max-width: 575.98px) {
            .search-course-pagination {
                display: flex;
                justify-content: center;
            }

            .search-course-pagination .pagination {
                justify-content: center;
                gap: 0.5rem;
            }

            .search-course-pagination .page-link,
            .search-course-pagination .page-item span {
                min-width: 42px;
                height: 42px;
                padding: 0 0.85rem;
                line-height: 40px;
                font-size: 0.9rem;
            }

            .search-course-pagination .page-item:first-child .page-link,
            .search-course-pagination .page-item:last-child .page-link,
            .search-course-pagination .page-item:first-child span,
            .search-course-pagination .page-item:last-child span {
                min-width: 86px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumb Starts Here -->
    <div class="event-sub-section event-sub-section--spaceY eventsearch-sub-section">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html" class="fs-6 text-secondary">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="course-search.html" class="fs-6 text-secondary">Khóa học</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb Ends Here -->

    <!-- Event Search Starts Here -->
    <section class="section event-search">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="event-search-bar">
                        <form action="{{ route('searchCourse') }}" method="get">
                            <div class="form-input-group">
                                <input type="text" class="form-control" name="textSearch"
                                    placeholder="Tìm kiếm khóa học..." />
                                <button class="button button-lg button--primary" type="submit" id="button-addon2">
                                    Tìm kiếm
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="accordion sidebar-filter" id="sidebarFilter">
                        <!-- Search by Category  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="categoryAcc">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#categoryCollapse" aria-expanded="true"
                                    aria-controls="categoryCollapse">
                                    Loại
                                </button>
                            </h2>
                            <div id="categoryCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="categoryAcc" data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="{{ route('searchCourse') }}" method="get">
                                        @csrf

                                        @forelse($category as $cat)
                                            @php
                                                $courseCount = $cat->course()->where('status', 2)->count();
                                            @endphp
                                            <div class="accordion-body__item">
                                                <div class="check-box">
                                                    <input type="checkbox" id="checkbo{{ $cat->id }}"
                                                        class="checkbox-primary" name="categories[]"
                                                        value="{{ $cat->id }}"
                                                        {{ in_array($cat->id, (array) $selectedCategories) ? 'checked' : '' }}>
                                                    <label for="checkbo{{ $cat->id }}"> {{ $cat->category_name }}
                                                    </label>
                                                </div>
                                                <p class="check-details">
                                                    {{ $courseCount }}
                                                </p>
                                            </div>
                                        @empty
                                        @endforelse
                                        <button type="submit" class="btn btn-primary">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Search by Level  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="levelAcc">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#levelCollapse" aria-expanded="false" aria-controls="levelCollapse">
                                    Mức độ
                                </button>
                            </h2>

                            <div id="levelCollapse" class="accordion-collapse collapse" aria-labelledby="levelAcc"
                                data-bs-parent="#sidebarFilter">

                                <div class="accordion-body">
                                    <form action="{{ route('searchCourse') }}" method="get">
                                        @csrf

                                        {{-- Mức độ 1 --}}
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" id="level1" class="checkbox-primary"
                                                    name="levels[]" value="1"
                                                    {{ in_array(1, (array) $selectedLevels) ? 'checked' : '' }}>
                                                <label for="level1"> Cơ bản </label>
                                            </div>
                                            <p class="check-details">
                                                {{ $levelCounts[1] ?? 0 }}
                                            </p>
                                        </div>

                                        {{-- Mức độ 2 --}}
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" id="level2" class="checkbox-primary"
                                                    name="levels[]" value="2"
                                                    {{ in_array(2, (array) $selectedLevels) ? 'checked' : '' }}>
                                                <label for="level2"> Trung cấp </label>
                                            </div>
                                            <p class="check-details">
                                                {{ $levelCounts[2] ?? 0 }}
                                            </p>
                                        </div>

                                        {{-- Mức độ 3 --}}
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" id="level3" class="checkbox-primary"
                                                    name="levels[]" value="3"
                                                    {{ in_array(3, (array) $selectedLevels) ? 'checked' : '' }}>
                                                <label for="level3"> Nâng cao </label>
                                            </div>
                                            <p class="check-details">
                                                {{ $levelCounts[3] ?? 0 }}
                                            </p>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Search by Price  -->
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Giá
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <div class="price-range">
                                        <div>
                                            <div class="price-range-block">
                                                <form class="d-flex price-range-block__inputWrapper" action="#">
                                                    <input type="number" min="0" max="5000"
                                                        oninput="validity.valid||(value='0');" id="min_price"
                                                        class="price-range-field"
                                                        style="width: 105px; height: 50px; border-radius: 4px; padding: 15px;" />
                                                    <span>đến</span>
                                                    <input type="number" min="0" max="5000"
                                                        oninput="validity.valid||(value='5000');" id="max_price"
                                                        class="price-range-field"
                                                        style="width: 125px; height: 50px; padding: 15px; border-radius: 4px;" />
                                                    <button class="angle-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-chevron-right">
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <div id="slider-range" class="price-filter-range"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Search by Rating  -->
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="ratingAcc">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ratingCollapse" aria-expanded="false"
                                    aria-controls="ratingCollapse">
                                    Xếp hạng
                                </button>
                            </h2>
                            <div id="ratingCollapse" class="accordion-collapse collapse" aria-labelledby="ratingAcc"
                                data-bs-parent="#sidebarFilter">
                                <div class="accordion-body">
                                    <form action="#">
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> Tất cả </label>
                                            </div>
                                            <p class="check-details">
                                                1,54,750
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 1 sao trở lên </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 2 sao trở lên </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 3 sao trở lên </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 4 sao trở lên </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                        <div class="accordion-body__item">
                                            <div class="check-box">
                                                <input type="checkbox" class="checkbox-primary" />
                                                <label> 5 sao </label>
                                            </div>
                                            <p class="check-details">
                                                45,770
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="event-search-results">
                        <div class="event-search-results-heading">
                            <div>
                                <h3 class="current">KHOÁ HỌC</h3>

                            </div>
                            <p>{{ $course->count() }} KHÓA HỌC.</p>
                            <button class="button button-lg button--primary button--primary-filter d-lg-none"
                                id="filter">
                                <span>
                                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.3335 14.9999V9.55554" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3.3335 6.4444V1" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.55469 14.9999V8" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M9.55469 4.88886V1" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7773 14.9999V11.1111" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7773 7.99995V1" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1 9.55554H5.66663" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M7.22217 4.88867H11.8888" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M13.4443 11.1111H18.111" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                Filter
                            </button>
                        </div>
                    </div>

                    {{-- Courses --}}
                    <div class="row event-search-content">
                        @forelse ($course as $c)
                            <div class="col-md-6 mb-4">
                                <div class="contentCard contentCard--course">
                                    <div class="contentCard-top">
                                        <a href="{{ route('courseDetails', encryptor('encrypt', $c->id)) }}"><img
                                                src="{{ asset('uploads/courses/' . $c->image) }}" alt="images"
                                                class="img-fluid" /></a>
                                    </div>
                                    <div class="contentCard-bottom">
                                        <h5>
                                            <a href="{{ route('courseDetails', ['id' => encryptor('encrypt', $c->id)]) }}"
                                                class="font-title--card">{{ $c->title }}</a>
                                        </h5>
                                        <div class="contentCard-info d-flex align-items-center justify-content-between">
                                            <a href="{{ route('instructorProfile', encryptor('encrypt', $c->instructor?->id)) }}"
                                                class="contentCard-user d-flex align-items-center">
                                                <img src="{{ $c->instructor?->image ? asset('uploads/users/' . $c->instructor->image) : asset('images/avatar/1.png') }}"
                                                    alt="Instructor Image" class="rounded-circle" height="34"
                                                    width="34" />
                                                <p class="font-para--md">{{ $c->instructor?->name_en }}</p>
                                            </a>
                                            <div class="price">
                                                <span>
                                                    {{ $c->price == null || $c->price == 0 ? 'Free' : number_format($c->price, 0, ',', '.') . ' VNĐ' }}
                                                </span>
                                                {{-- <del>
                                                    {{ $c->old_price ? number_format($c->old_price, 0, ',', '.') . ' VNĐ' : '' }}
                                                </del> --}}
                                            </div>
                                        </div>
                                        <div class="contentCard-more">
                                            {{-- <div class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/star.png') }}"
                                                        alt="star" />
                                                </div>
                                                <span>4.5</span>
                                            </div> --}}
                                            <div class="eye d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/eye.png') }}"
                                                        alt="eye" />
                                                </div>
                                                <span>24,517</span>
                                            </div>
                                            <div class="book d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/book.png') }}"
                                                        alt="location" />
                                                </div>
                                                <span>{{ $c->lesson }} BÀI HỌC</span>
                                            </div>
                                            <div class="clock d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/dist/images/icon/Clock.png') }}"
                                                        alt="clock" />
                                                </div>
                                                <span>{{ $c->duration }} GIỜ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-6 mb-4">
                                <div class="contentCard contentCard--course">
                                    <h3>Không tìm thấy khóa học</h3>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="search-course-pagination d-flex justify-content-start">
                        {{ $course->links('vendor.pagination.search-course') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/price_range_script.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery-ui.min.js') }}"></script>
    <script>
        const filterBtn = document.querySelector("#filter");
        const cross = document.querySelector(".filter--cross");

        filterBtn.addEventListener("click", function() {
            let sidebar = document.querySelector(".filter-sidebar");
            sidebar.classList.toggle("active");
        });

        cross.addEventListener("click", function() {
            let sidebar = document.querySelector(".filter-sidebar");
            sidebar.classList.remove("active");
        });
    </script>
@endpush
