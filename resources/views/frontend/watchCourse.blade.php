<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ ENV('APP_NAME') }} | @yield('title', 'Watch Course')</title>
    <link rel="stylesheet" href="{{ asset('frontend/src/scss/vendors/plugin/css/video-js.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/src/scss/vendors/plugin/css/star-rating-svg.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/dist/main.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('frontend/dist/images/favicon/favicon.png') }}" />


    <link rel="stylesheet" href="{{ asset('frontend/fontawesome-free-5.15.4-web/css/all.min.css') }}">
    <style>
        .vjs-poster {
            width: 100%;
            background-size: cover;
        }
    </style>

</head>

<body style="background-color: #ebebf2;">
    <!-- Title Starts Here -->
    <header class="bg-transparent">
        <div class="container-fluid">
            <div class="coursedescription-header">
                <div class="coursedescription-header-start">
                    <a class="logo-image" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/dist/images/logo/logo.png') }}" alt="Logo" />
                    </a>
                    <div class="topic-info">
                        <div class="topic-info-arrow">
                            <a href="{{ URL::previous() }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <div class="topic-info-text">
                            <h6 class="font-title--xs"><a href="#">{{ $course->title }}</a></h6>
                            <div class="lesson-hours">
                                <div class="book-lesson">
                                    <i class="fas fa-book-open text-primary"></i>
                                    <span>{{ $course->lesson ? $course->lesson : 0 }} Bài học</span>
                                </div>
                                {{-- <div class="totoal-hours">
                                    <i class="far fa-clock text-danger"></i>
                                    <span>{{ $course->duration ? $course->duration : 0 }} Giờ</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="coursedescription-header-end">
                    <!-- <a href="#" class="rating-link" data-bs-toggle="modal" data-bs-target="#ratingModal">Leave a Rating</a> -->
                    <a href="#" class="button button--primary" data-bs-toggle="modal"
                        data-bs-target="#ratingModal">Để lại đánh giá</a>

                    <!-- <a href="#" class="btn btn-primary regular-fill-btn">Next Lession</a> -->
                    {{-- <button class="button button--primary">Bài học tiếp theo</button> --}}
                </div>
            </div>
        </div>
    </header>
    <!-- Ttile Ends Here -->

    <!-- Course Description Starts Here -->
    <div class="container-fluid">
        <div class="row course-description">

            {{-- Video Area --}}
            <div class="col-lg-8">
                <div class="course-description-start">
                    <div class="video-area">
                        <video controls id="myvideo" class="video-js w-100"
                            poster="{{ asset('frontend/dist/images/courses/videol.jpg') }}">
                            <source src="" class="w-100" />
                        </video>
                    </div>
                    {{-- Tab --}}
                    <div class="course-description-start-content">
                        <h5 class="font-title--sm material-title">{{ $course->title }}</h5>
                        <nav class="course-description-start-content-tab">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-ldescrip-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-ldescrip" type="button" role="tab"
                                    aria-controls="nav-ldescrip" aria-selected="true">
                                    Mô tả bài học
                                </button>
                                <button class="nav-link" id="nav-lnotes-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-lnotes" type="button" role="tab"
                                    aria-controls="nav-lnotes" aria-selected="false">Ghi chú bài học</button>
                                <button class="nav-link"> <a href="http://127.0.0.1:8001/vi/test-set-category/4"
                                        target="_blank">Tham
                                        gia ôn luyện TOEIC</a></button>
                                {{-- <button class="nav-link" id="nav-lcomments-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-lcomments" type="button" role="tab"
                                    aria-controls="nav-lcomments" aria-selected="false">Bình luận</button> --}}
                                {{-- <button class="nav-link" id="nav-loverview-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-loverview" type="button" role="tab"
                                    aria-controls="nav-loverview" aria-selected="false">Tổng quan</button>
                                <button class="nav-link" id="nav-linstruc-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-linstruc" type="button" role="tab"
                                    aria-controls="nav-linstruc" aria-selected="false">Giảng viên</button> --}}
                            </div>
                        </nav>
                        <div class="tab-content course-description-start-content-tabitem" id="nav-tabContent">
                            <!-- Mô tả bài học Starts Here -->
                            <div class="tab-pane fade show active" id="nav-ldescrip" role="tabpanel"
                                aria-labelledby="nav-ldescrip-tab">
                                <div class="lesson-description">
                                    <div
                                        style="max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                                        <p>
                                            Khóa học tiếng Anh mà tôi tham gia thực sự là một <strong>trải nghiệm đáng
                                                giá</strong>, không chỉ giúp cải thiện khả năng ngôn ngữ mà còn mở ra
                                            nhiều cơ hội mới trong học tập và công việc. Từ buổi học đầu tiên, tôi đã
                                            nhận thấy sự khác biệt so với cách học truyền thống, bởi mỗi bài học đều
                                            được thiết kế <em>rất khoa học</em>, kết hợp giữa ngữ pháp, từ vựng, kỹ năng
                                            nghe, nói, đọc và viết một cách hài hòa.
                                        </p>

                                        <p>
                                            Giáo viên không chỉ truyền đạt kiến thức một cách sinh động mà còn tạo ra
                                            môi trường học tập tương tác, khuyến khích học viên tham gia vào các hoạt
                                            động nhóm, thảo luận và thực hành ngôn ngữ trực tiếp. Ngoài ra, khóa học còn
                                            cung cấp nhiều tài liệu học tập đa dạng, từ sách, bài tập online cho đến các
                                            video minh họa sống động, giúp việc ôn luyện tại nhà trở nên <strong>dễ dàng
                                                và hiệu quả hơn</strong>.
                                        </p>

                                        <p>
                                            Một điểm nổi bật khác của khóa học là việc chú trọng đến việc phát triển
                                            <em>kỹ năng giao tiếp thực tế</em>, với các tình huống mô phỏng đời sống,
                                            giúp học viên tự tin hơn khi nói tiếng Anh trong các cuộc hội thoại hàng
                                            ngày, phỏng vấn hoặc thuyết trình. Qua từng tuần học, tôi cảm nhận rõ rệt sự
                                            tiến bộ của bản thân, từ việc hiểu và sử dụng ngữ pháp chuẩn, mở rộng vốn từ
                                            vựng, đến khả năng phát âm và phản xạ nhanh khi nghe – nói.
                                        </p>

                                        <p>
                                            Không những thế, khóa học còn xây dựng một cộng đồng học viên <strong>thân
                                                thiện</strong>, nơi mọi người có thể trao đổi kinh nghiệm, chia sẻ mẹo
                                            học tập và động viên nhau cùng tiến bộ. Nhìn lại chặng đường đã qua, tôi
                                            nhận ra rằng khóa học này không chỉ đơn thuần là học tiếng Anh, mà còn là
                                            một hành trình phát triển bản thân, rèn luyện sự kiên nhẫn, kỷ luật và tinh
                                            thần tự học, mở ra nhiều cánh cửa mới trong học tập, sự nghiệp và cả trong
                                            giao tiếp quốc tế.
                                        </p>
                                    </div>

                                </div>
                                <!-- Mô tả bài học Ends Here -->
                            </div>
                            <!-- Course Notes Starts Here -->
                            <div class="tab-pane fade" id="nav-lnotes" role="tabpanel" aria-labelledby="nav-lnotes-tab">
                                <div class="course-notes-area">
                                    <div class="course-notes">
                                        <div class="course-notes-item">
                                            <p>
                                                Bạn cần dành chút thời gian để hiểu mục tiêu là gì, vấn đề là gì, họ
                                                đang cố gắng đạt được điều gì, đối tượng mục tiêu là ai, đối thủ cạnh
                                                tranh là ai, và hiểu rõ bạn đang cố gắng làm gì ở đây và sự thành công
                                                của dự án sẽ như thế nào. Về cơ bản, cách để làm điều đó là bằng cách
                                                làm hai việc.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Course Notes Ends Here -->
                            </div>
                            <!-- Lesson Comments Starts Here -->
                            <div class="tab-pane fade" id="nav-lcomments" role="tabpanel"
                                aria-labelledby="nav-lcomments-tab">
                                <div class="lesson-comments">
                                    <div class="feedback-comment pt-0 ps-0 pe-0">
                                        <h6 class="font-title--card">Bình luận bài học</h6>
                                        <form action="#">
                                            <label for="comment">Bình luận</label>
                                            <textarea class="form-control" id="comment"></textarea>
                                            <button type="submit"
                                                class="button button-md button--primary float-end">Gửi bình
                                                luận</button>
                                        </form>
                                    </div>
                                    <div class="students-feedback pt-0 ps-0 pe-0 pb-0 mb-0">
                                        <div class="students-feedback-heading">
                                            <h5 class="font-title--card">Bình luận <span>(57,685)</span></h5>
                                        </div>
                                        <div class="students-feedback-item">
                                            <div class="feedback-rating">
                                                <div class="feedback-rating-start">
                                                    <div class="image">
                                                        <img src="{{ asset('frontend/dist/images/ellipse/user.jpg') }}"
                                                            alt="Image" />
                                                    </div>
                                                    <div class="text">
                                                        <h6><a href="#">Đức Long</a></h6>
                                                        <p>1 giờ trước</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Khóa học này thực sự rất bổ ích. Tôi đã học được nhiều kiến thức mới và
                                                cải thiện khả năng giao tiếp tiếng Anh của mình rất nhiều 😀
                                            </p>
                                        </div>

                                        <div class="students-feedback-item">
                                            <div class="feedback-rating">
                                                <div class="feedback-rating-start">
                                                    <div class="image">
                                                        <img src="{{ asset('frontend/dist/images/ellipse/1.png') }}"
                                                            alt="Image" />
                                                    </div>
                                                    <div class="text">
                                                        <h6><a href="#">Hải Yến</a></h6>
                                                        <p>2 giờ trước</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Thầy cô rất nhiệt tình và dễ hiểu, các bài tập và ví dụ thực hành giúp
                                                tôi nhớ kiến thức lâu hơn.
                                            </p>
                                        </div>

                                        <div class="students-feedback-item">
                                            <div class="feedback-rating">
                                                <div class="feedback-rating-start">
                                                    <div class="image">
                                                        <img src="{{ asset('frontend/dist/images/ellipse/2.png') }}"
                                                            alt="Image" />
                                                    </div>
                                                    <div class="text">
                                                        <h6><a href="#">A Páo</a></h6>
                                                        <p>1 ngày trước</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Các bài học được thiết kế rất khoa học và dễ theo dõi. Tôi cảm thấy tự
                                                tin hơn khi giao tiếp tiếng Anh hàng ngày.
                                            </p>
                                        </div>

                                        <div class="students-feedback-item border-0">
                                            <div class="feedback-rating">
                                                <div class="feedback-rating-start">
                                                    <div class="image">
                                                        <img src="{{ asset('frontend/dist/images/ellipse/3.png') }}"
                                                            alt="Image" />
                                                    </div>
                                                    <div class="text">
                                                        <h6><a href="#">Tuấn Anh</a></h6>
                                                        <p>1 ngày trước</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Tôi thực sự hài lòng với khóa học này. Các kiến thức được truyền đạt rất
                                                chi tiết, dễ áp dụng và phù hợp với mọi trình độ.
                                            </p>
                                        </div>

                                        <button class="button button-md button--primary-outline">Xem thêm</button>
                                    </div>
                                </div>
                                <!-- Lesson Comments Ends Here -->
                            </div>
                            <!-- Course Overview Starts Here -->
                            <div class="tab-pane fade" id="nav-loverview" role="tabpanel"
                                aria-labelledby="nav-loverview-tab">
                                <div class="row course-overview-main">
                                    <div class="course-overview-main-item">
                                        <h6 class="font-title--card">Description</h6>
                                        <p class="mb-3 font-para--lg">
                                            {{ $course->description_en }}
                                        </p>
                                    </div>
                                    <div class="course-overview-main-item">
                                        <h6 class="font-title--card">Requirments</h6>
                                        <p class="mb-2 font-para--lg">
                                            {{ $course->prerequisites_en }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Course Overview Ends Here -->
                            </div>
                            <!-- course details instructor  -->
                            <div class="tab-pane fade" id="nav-linstruc" role="tabpanel"
                                aria-labelledby="nav-linstruc-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="course-instructor mw-100">
                                            <div class="course-instructor-info">
                                                <div class="instructor-image">
                                                    <img src="{{ asset('uploads/users/' . $course?->instructor?->image) }}"
                                                        alt="Instructor" />
                                                </div>
                                                <div class="instructor-text">
                                                    <h6 class="font-title--xs">
                                                        <a
                                                            href="{{ route('instructorProfile', encryptor('encrypt', $course->instructor->id)) }}">
                                                            {{ $course?->instructor?->name_en }}</a>
                                                    </h6>
                                                    <p>{{ $course?->instructor?->designation }}</p>
                                                    <div class="d-flex align-items-center instructor-text-bottom">
                                                        <div class="d-flex align-items-center ratings-icon">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9.94438 2.34287L11.7457 5.96656C11.8359 6.14934 12.0102 6.2769 12.2124 6.30645L16.2452 6.88901C16.4085 6.91079 16.5555 6.99635 16.6559 7.12701C16.8441 7.37201 16.8153 7.71891 16.5898 7.92969L13.6668 10.7561C13.5183 10.8961 13.4522 11.1015 13.4911 11.3014L14.1911 15.2898C14.2401 15.6204 14.0145 15.93 13.684 15.9836C13.5471 16.0046 13.4071 15.9829 13.2826 15.9214L9.69082 14.0384C9.51037 13.9404 9.29415 13.9404 9.1137 14.0384L5.49546 15.9315C5.1929 16.0855 4.82267 15.9712 4.65778 15.6748C4.59478 15.5551 4.57301 15.419 4.59478 15.286L5.29479 11.2975C5.32979 11.0984 5.26368 10.8938 5.11901 10.753L2.18055 7.92735C1.94099 7.68935 1.93943 7.30201 2.17821 7.06246C2.17899 7.06168 2.17977 7.06012 2.18055 7.05935C2.27932 6.9699 2.40066 6.91001 2.5321 6.88668L6.56569 6.30412C6.76713 6.27223 6.94058 6.14623 7.03236 5.96345L8.83215 2.34287C8.90448 2.19587 9.03281 2.08309 9.18837 2.03176C9.3447 1.97965 9.51582 1.99209 9.66282 2.06598C9.78337 2.12587 9.88215 2.22309 9.94438 2.34287Z"
                                                                    stroke="#FF7A1A" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                            <p>4.9 Star Rating</p>
                                                        </div>
                                                        <div class="d-flex align-items-center ratings-icon">
                                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.5 2.25H6C6.79565 2.25 7.55871 2.56607 8.12132 3.12868C8.68393 3.69129 9 4.45435 9 5.25V15.75C9 15.1533 8.76295 14.581 8.34099 14.159C7.91903 13.7371 7.34674 13.5 6.75 13.5H1.5V2.25Z"
                                                                    stroke="#00AF91" stroke-width="1.8"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M16.5 2.25H12C11.2044 2.25 10.4413 2.56607 9.87868 3.12868C9.31607 3.69129 9 4.45435 9 5.25V15.75C9 15.1533 9.23705 14.581 9.65901 14.159C10.081 13.7371 10.6533 13.5 11.25 13.5H16.5V2.25Z"
                                                                    stroke="#00AF91" stroke-width="1.8"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>

                                                            <p>5 Courses</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="lead-p">{{ $course?->instructor?->title }}
                                            </p>
                                            <p class="course-instructor-description">
                                                {{ $course?->instructor?->bio }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Index Course Contents --}}
            <div class="col-lg-4">
                <div class="videolist-area">
                    <!-- Tabs nav -->
                    <ul class="nav nav-tabs border-button " id="lessonTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="lessons-tab" data-bs-toggle="tab"
                                data-bs-target="#lessons" type="button" role="tab" aria-controls="lessons"
                                aria-selected="true">
                                Bài học
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="quizzes-tab" data-bs-toggle="tab" data-bs-target="#quizzes"
                                type="button" role="tab" aria-controls="quizzes" aria-selected="false">
                                Bài kiểm tra
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="quizDone-tab" data-bs-toggle="tab"
                                data-bs-target="#quizDone" type="button" role="tab" aria-controls="quizDone"
                                aria-selected="false">
                                Bài thi đã làm
                            </button>
                        </li>
                    </ul>

                    <!-- Tabs content -->
                    <div class="tab-content mt-3" id="lessonTabsContent">
                        <!-- Tab 1: Bài học -->
                        <div class="tab-pane fade show active" id="lessons" role="tabpanel"
                            aria-labelledby="lessons-tab">
                            <div class="videolist-area-heading">
                                <h6>Nội dung bài học</h6>
                                {{-- <p>Hoàn thành 5%</p> --}}
                            </div>
                            {{-- <div class="videolist-area-bar">
                                <span class="videolist-area-bar--progress"></span>
                            </div> --}}
                            <div class="videolist-area-bar__wrapper">
                                @foreach ($lessons as $lesson)
                                    <div class="videolist-area-wizard"
                                        data-lesson-description="{{ $lesson->description }}"
                                        data-lesson-notes="{{ $lesson->notes }}">

                                        <div class="wizard-heading"
                                            style="cursor: pointer; display: flex; justify-content: space-between; align-items: center;"
                                            onclick="toggleLesson(this)">
                                            <h6 class="mb-0">{{ $loop->iteration }}. {{ $lesson->title }}</h6>
                                            <i class="fas fa-chevron-down rotate-icon"></i>
                                        </div>

                                        <div class="lesson-materials" style="display: none; margin-top: 8px;">

                                            @php
                                                $videoMaterials = $lesson->material->where('type', 'video');
                                                $otherMaterials = $lesson->material->where('type', '!=', 'video');
                                                $materialIndex = 1;
                                            @endphp

                                            {{-- VIDEO TRƯỚC --}}
                                            @foreach ($videoMaterials as $material)
                                                <div class="main-wizard"
                                                    data-material-title="{{ $loop->parent->iteration }}.{{ $materialIndex }} {{ $material->title }}">
                                                    <div class="main-wizard__wrapper">
                                                        <a class="main-wizard-start"
                                                            onclick="show_video('{{ $material->content }}')">
                                                            <div class="main-wizard-icon">
                                                                <i class="far fa-play-circle fa-lg"></i>
                                                            </div>
                                                            <div class="main-wizard-title">
                                                                <p>{{ $loop->parent->iteration }}.{{ $materialIndex }}
                                                                    {{ $material->title }}</p>
                                                            </div>
                                                        </a>

                                                        <div class="main-wizard-end d-flex align-items-center">
                                                            <span>12:34</span>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    style="border-radius: 0px; margin-left: 5px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $materialIndex++; @endphp
                                            @endforeach

                                            {{-- FILE KHÁC (document, pdf, ...) --}}
                                            @foreach ($otherMaterials as $material)
                                                <div class="main-wizard"
                                                    data-material-title="{{ $loop->parent->iteration }}.{{ $materialIndex }} {{ $material->title }}">
                                                    <div class="main-wizard__wrapper">

                                                        @if ($material->type == 'document')
                                                            <a class="main-wizard-start"
                                                                onclick="open_file('{{ $material->content }}')">
                                                                <div class="main-wizard-icon">
                                                                    <i class="fas fa-book fa-lg text-success"></i>
                                                                </div>
                                                                <div class="main-wizard-title">
                                                                    <p>{{ $loop->parent->iteration }}.{{ $materialIndex }}
                                                                        {{ $material->title }}</p>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <a class="main-wizard-start">
                                                                <div class="main-wizard-icon">
                                                                    <i class="fas fa-file fa-lg"></i>
                                                                </div>
                                                                <div class="main-wizard-title">
                                                                    <p>{{ $loop->parent->iteration }}.{{ $materialIndex }}
                                                                        {{ $material->title }}</p>
                                                                </div>
                                                            </a>
                                                        @endif

                                                        <div class="main-wizard-end d-flex align-items-center">
                                                            <span>--:--</span>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    style="border-radius: 0px; margin-left: 5px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $materialIndex++; @endphp
                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Tab 2: Bài kiểm tra -->
                        <div class="tab-pane fade" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                            <div class="videolist-area-heading">
                                <h6>Danh sách bài kiểm tra</h6>
                                <p>Có {{ count($course->quiz ?? []) }} bài kiểm tra</p>
                            </div>

                            @if (!empty($course->quiz))
                                <div class="list-group mt-3 px-4">
                                    @foreach ($course->quiz as $quiz)
                                        <a href="#"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#startExamModal"
                                            onclick="nameQuiz('{{ $quiz->title }}', '{{ $quiz->test_time }}', '{{ $quiz->id }}')">
                                            <span><i
                                                    class="fas fa-clipboard-list me-2 text-primary"></i>{{ $quiz->title }}</span>
                                            <span class="badge bg-success">Làm bài</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mt-3 px-4">Chưa có bài kiểm tra nào.</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="quizDone" role="tabpanel" aria-labelledby="quizDone-tab">
                            <div class="videolist-area-heading">
                                <h6>Bài kiểm tra đã làm </p>
                            </div>
                            @if (!empty($course->quiz))
                                <div class="list-group mt-3 px-4">
                                    @foreach ($course->quiz as $quiz)
                                        @if ($studentTests->where('quiz_id', $quiz->id)->count() > 0)
                                            <a href="#"
                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-light text-muted"
                                                style="cursor: default;">
                                                <span>
                                                    <i
                                                        class="fas fa-check-circle me-2 text-success"></i>{{ $quiz->title }}
                                                </span>
                                            </a>
                                        @endif
                                        <?php $attempt_number = 0; ?>

                                        @foreach ($studentTests as $sTest)
                                            @if ($sTest->quiz_id == $quiz->id)
                                                <a class="ps-5 py-2 border-start"
                                                    href="{{ route('test.result', $sTest->id) }}">
                                                    <i class="fas fa-angle-right me-2 text-muted"></i>
                                                    <span class="fw-light">Lần làm:
                                                        <?= ++$attempt_number ?></span> —
                                                    <span class="text-success">Điểm:
                                                        {{ $sTest->score }}/10</span>
                                                    <span
                                                        class="text-muted small ms-2">({{ $sTest->created_at->format('d/m/Y') }})</span>
                                                </a>
                                            @endif
                                        @endforeach
                                        {{-- @if ($attempt_number <= 0)
                                            <small class="fload"> Chưa làm bài </small>
                                        @endif --}}
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mt-3 px-4">Chưa làm bài thi nào.</p>
                            @endif
                        </div>
                    </div>

                    <!-- CSS -->
                    <style>
                        .rotate-icon {
                            transition: transform 0.3s ease;
                        }

                        .rotate-icon.rotated {
                            transform: rotate(180deg);
                        }

                        .nav-tabs .nav-link {
                            color: #000;
                            /* tab bình thường là màu đen */
                        }

                        .nav-tabs .nav-link.active {
                            color: #0d6efd;
                            /* tab active màu xanh Bootstrap */
                            font-weight: 600;
                            border-color: #0d6efd #0d6efd #fff;
                            /* cho viền xanh đồng bộ */
                        }

                        .main-wizard.is-active .main-wizard__wrapper {
                            background: #e7f1ff;
                            border-left: 3px solid #0d6efd;
                        }

                        .main-wizard.is-active .main-wizard-title p {
                            color: #0d6efd;
                            font-weight: 600;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Description Ends Here -->

    {{-- Modal xác nhận làm bài kiểm tra --}}
    <div class="modal fade" id="startExamModal" tabindex="-1" aria-labelledby="startExamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="startExamModalLabel">BÀI KIỂM TRA</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Đóng"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <h5 class="fw-bold mb-3">Bài kiểm tra: <span class="text-primary" id="name-quiz"></span></h5>
                    <p class="mb-4">Thời gian làm bài: <strong id="test_time">45 phút</strong></p>
                    <p>Bạn có chắc chắn muốn bắt đầu làm bài kiểm tra này không?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" onclick="startQuiz()" class="btn btn-success">Bắt đầu làm bài</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal đánh giá -->
    <div class="modal fade modal--rating" id="ratingModal" tabindex="-1" aria-labelledby="ratingModal"
        aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Để lại đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0 pb-0">
                    <div class="modal-body-rating">
                        <p>4.5 <span>(Tốt/Tuyệt vời)</span></p>
                        <div class="my-rating rating-icons rating-icons-modal"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <form action="#" class="w-100">
                        <label for="messages">Đánh giá</label>
                        <textarea id="messages" placeholder="Bạn cảm thấy thế nào khi tham gia khóa học này?" class="w-100"></textarea>
                        <button type="submit" class="button button-md button--primary w-100">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- 2. Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- 3. Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#ratingModal form');
            const modalEl = document.getElementById('ratingModal');
            const bootstrapModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // ngăn form reload trang

                // Đóng modal
                bootstrapModal.hide();

                // Hiện thông báo thành công bằng Toastr
                toastr.success("Cảm ơn bạn! Đánh giá của bạn đã được ghi nhận.");
            });
        });
    </script>



    <script>
        var idQuiz = null;
        // toggleLesson: đặt trực tiếp (sau khi jQuery đã load)
        function toggleLesson(element) {
            const $lessonWrapper = $(element).closest('.videolist-area-wizard');
            const $materials = $lessonWrapper.find('.lesson-materials');
            const $icon = $(element).find('.rotate-icon');

            // Đóng các lesson khác
            $('.lesson-materials').not($materials).slideUp(200);
            $('.rotate-icon').not($icon).removeClass('rotated');

            // Mở / đóng lesson hiện tại
            $materials.slideToggle(200);
            $icon.toggleClass('rotated');
        }
        // Gắn tên bài kiểm tra vào modal
        function nameQuiz(title, test_time, id) {
            idQuiz = id;
            console.log(title);
            document.getElementById('name-quiz').textContent = title;
            document.getElementById('test_time').textContent = test_time + ' phút';
        }
        // Bắt đầu làm bài
        const baseRoute = "{{ route('test', ':id') }}"; // :id là placeholder
        function startQuiz() {
            if (!idQuiz) return;
            const url = baseRoute.replace(':id', idQuiz);
            window.location.href = url;
        }
    </script>

    <!-- Các script thư viện: GIỮ 1 bản jQuery THÔI. -->
    <!-- Xóa hoặc comment dòng duplicate jQuery (dưới đây giữ file local, comment CDN) -->
    <script src="{{ asset('frontend/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/src/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/video.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/src/scss/vendors/plugin/js/jquery.star-rating-svg.js') }}"></script>
    <script src="{{ asset('frontend/src/js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

    <!-- Nếu bạn muốn dùng CDN thay file local, hãy comment file local ở trên và mở dòng dưới -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

    <script>
        // ensure DOM ready
        $(function() {
            // Nếu bạn muốn chỉ click header để toggle (không click toàn wrapper),
            // hãy bỏ bớt handler on '.videolist-area-wizard' hoặc dùng stopPropagation ở đây.

            // Keep description/notes default (no auto update on lesson click)


            // Khi click v�o material (item), update ti�u d? + highlight
            function setActiveMaterial($item) {
                if (!$item || $item.length === 0) return;
                $(".main-wizard").removeClass("is-active");
                $item.addClass("is-active");
                var materialTitle = $item.data("material-title") || "";
                if (materialTitle) {
                    $(".material-title").text(materialTitle);
                }
            }

            $(".main-wizard").on("click", function(e) {
                setActiveMaterial($(this));
                // stop parent click (n?u c�)
                e.stopPropagation();
            });

            // N?u a.main-wizard-start c� onclick show_video/open_file th� v?n c?p nh?t ti�u d?
            $(".main-wizard-start").on("click", function(e) {
                setActiveMaterial($(this).closest(".main-wizard"));
                e.stopPropagation();
                // ti?p t?c d? onclick inline ch?y (show_video/open_file)
            });

            // starRating init (giữ nguyên)
            if ($.fn.starRating) {
                $(".my-rating").starRating({
                    starSize: 30,
                    activeColor: "#FF7A1A",
                    hoverColor: "#FF7A1A",
                    ratedColors: ["#FF7A1A", "#FF7A1A", "#FF7A1A", "#FF7A1A", "#FF7A1A"],
                    starShape: "rounded",
                });
            }

            // show_video function dùng vanilla (bạn đã có bản dưới, giữ hoặc thay thế)
            window.show_video = function(e) {
                let link = "{{ asset('uploads/courses/contents') }}/" + e;
                var video = document.getElementById('myvideo');
                if (video) {
                    // set source properly for <video> element
                    // nếu <video> có <source>, update src on source then load()
                    var source = video.querySelector('source');
                    if (source) {
                        source.src = link;
                        video.load();
                        video.play().catch(() => {});
                    } else {
                        video.src = link;
                        video.play().catch(() => {});
                    }
                }
            };

            // open_file: nếu bạn có, define giống show_video nhưng mở tab mới
            window.open_file = function(path) {
                let link = "{{ asset('uploads/courses/contents') }}/" + path;
                window.open(link, '_blank');
            };
        });
    </script>


</body>

</html>
