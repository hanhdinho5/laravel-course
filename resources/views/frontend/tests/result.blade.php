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

        .info-line {
            display: flex;
            align-items: flex-start;
            margin-bottom: 6px;
        }

        .info-label {
            width: 155px;
            /* tùy chỉnh để các label đều thẳng */
            font-weight: 500;
        }

        .info-content {
            flex: 1;
            position: relative;
        }

        .info-content i {
            position: absolute;
            right: 0;
            /* căn icon sang phải */
            top: 0;
        }
    </style>

</head>

<body style="background-color: #ebebf2;">

    <style>
        .result-header {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            padding: 18px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .result-header__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .result-logo img {
            height: 42px;
        }

        .result-info {
            flex: 1;
            text-align: center;
            color: #fff;
        }

        .result-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .result-alert {
            margin-top: 6px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
        }

        .result-alert i {
            color: #22c55e;
        }

        .result-action .button {
            padding: 10px 18px;
            font-size: 14px;
            border-radius: 8px;
        }
    </style>
    <!-- Title Starts Here -->
    <header class="result-header">
        <div class="container">
            <div class="result-header__inner">

                <!-- Logo -->
                <a class="result-logo" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/dist/images/logo/logo.png') }}" alt="Logo">
                </a>

                <!-- Title + status -->
                <div class="result-info">
                    <h4 class="result-title">Kết quả làm bài</h4>
                    <div class="result-alert">
                        <i class="fas fa-check-circle"></i>
                        <span>Bạn đã nộp bài thành công</span>
                    </div>
                </div>

                <!-- Action -->
                <div class="result-action">
                    <a href="http://127.0.0.1:8000/students/watchCourse/UlplTGJTNWg1K1pJNGpzVEVaZXJJQT09"
                        class="button button--primary">
                        Quay lại
                    </a>
                </div>

            </div>
        </div>
    </header>

    <div class="container py-4">
        <h3 class="mb-2">{{ $studentTest->quiz->title }}</h3>
        <p>Điểm: <strong style="padding-left: 86px">{{ $studentTest->score }}</strong></p>
        <p>Số câu đúng: <strong
                style="padding-left: 27px">{{ $studentTest->correct_count }}/{{ $studentTest->total_questions }}</strong>
        </p>
        <p class="mb-3">Thời gian:
            @php
                $seconds = $studentTest->finished_at->diffInSeconds($studentTest->started_at);
                $minutes = floor($seconds / 60);
                $remainingSeconds = $seconds % 60;
            @endphp

            <strong style="padding-left: 54px">
                {{ $minutes }} phút {{ $remainingSeconds }} giây
            </strong>
        </p>

        @foreach ($studentTest->studentAnswer as $index => $item)
            @php
                $check = strtoupper($item->selected_answer) == strtoupper($item->question->correct_answer);
            @endphp
            <div class="card mb-3 {{ $item->question->is_correct ? 'border-success' : 'border-danger' }}">
                <div class="card-header">
                    <strong>Câu {{ $index + 1 }}:</strong> {{ $item->question->content }}
                </div>
                <div class="card-body">
                    <div class="info-line">
                        <span class="info-label">Đáp án bạn chọn:</span>
                        <span class="info-content">
                            <strong
                                class="{{ $check ? 'text-success' : 'text-danger' }}">{{ strtoupper($item->selected_answer ?? 'Trống') }}</strong>
                            {{ $item->question->{'option_' . $item->selected_answer} }}
                            <i
                                class="fas {{ $check ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i>
                        </span>
                    </div>
                    @if (strtoupper($item->question->correct_answer) != strtoupper($item->selected_answer))
                        <div class="info-line">
                            <span class="info-label">Đáp án đúng:</span>
                            <span class="info-content">
                                <strong class="text-success">{{ strtoupper($item->question->correct_answer) }}</strong>
                                {{ $item->question->{'option_' . $item->question->correct_answer} }}
                            </span>
                        </div>
                    @endif

                    <div class="info-line">
                        <span class="info-label">Giải thích:</span>
                        <span class="info-content">{{ $item->question->explain ?? 'Không có' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
