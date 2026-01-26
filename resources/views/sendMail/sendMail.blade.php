<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận đăng ký khóa học</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; margin: 0; padding: 0;">
    <div
        style="width: 80%; margin: 30px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0px 0px 8px #cccccc;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px; text-align: center; color: #2c3e50;">
            Xác nhận đăng ký khóa học thành công!
        </h1>

        <p style="font-size: 16px; color: #333333; line-height: 1.6;">
            Cảm ơn bạn <strong>{{ $info['name_student'] }}</strong> đã đăng ký học tại nền tảng <a href="/"
                style="color: #007bff; text-decoration: none;">KHOÁ HỌC TRỰC TUYẾN</a>.
            Việc đăng ký của bạn đã được ghi nhận thành công. Dưới đây là thông tin chi tiết:
        </p>

        <ul style="margin: 10px 0; padding: 0; list-style: none; font-size: 15px; color: #333;">
            <li><strong style="margin-right: 10px;">Tên học viên:</strong> {{ $info['name_student'] }}</li>
            {{-- <li><strong style="margin-right: 10px;">Số điện thoại:</strong> {{ $phone }}</li> --}}
            <li><strong style="margin-right: 10px;">Email:</strong> {{ $info['email_student'] }}</li>
        </ul>

        <h3 style="margin-top: 25px; font-size: 18px; color: #2c3e50;">Danh sách khóa học đã đăng ký:</h3>
        <table
            style="width: 100%; border-collapse: collapse; margin-top: 10px; border: 1px solid #ccc; font-size: 15px;">
            <thead style="background-color: #007bff; color: white;">
                <tr>
                    <th style="padding: 10px; border: 1px solid #ccc;">#</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Tên khóa học</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Giảng viên</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($cart as $course)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc; text-align: center;">{{ ++$i }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $course['title'] }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $course['instructor'] }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc; text-align: right;">
                            {{ number_format($course['price'], 0, ',', '.') }} VNĐ
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 15px; font-size: 16px;">
            <strong>Tổng số khóa học:</strong> {{ count($cart) }} <br>
            <strong>Tổng học phí:</strong> <span
                style="color: #e74c3c; font-weight: bold;">{{ number_format($info['total'], 0, ',', '.') }} VNĐ</span>
        </p>

        <div style="margin-top: 25px; padding: 15px; background-color: #f9f9f9; border-left: 4px solid #007bff;">
            <h3 style="margin-top: 0; color: #007bff;">Hướng dẫn thanh toán:</h3>
            <p style="margin: 0; font-size: 15px;">
                Vui lòng thanh toán trực tiếp vào tài khoản sau để kích hoạt các khóa học của bạn:
            </p>
            <ul style="margin: 10px 0 0 20px; padding: 0; font-size: 15px;">
                <li><strong>Ngân hàng:</strong> MB Bank</li>
                <li><strong>Số tài khoản:</strong> 01622147641176</li>
                <li><strong>Chủ tài khoản:</strong> LU A HANH</li>
                <li>
                    Khi chuyển khoản, vui lòng ghi đúng nội dung sau:<br>
                    <strong style="color:red">{{ $info['order_code'] }}</strong>
                </li>
            </ul>
            <p style="margin-top: 10px; font-style: italic; color: #666;">
                Sau khi thanh toán, các khóa học của bạn sẽ được kích hoạt trong thời gian sớm nhất.
            </p>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="http://127.0.0.1:8000/searchCourse"
                style="display: inline-block; background-color: #007bff; color: #ffffff; font-size: 16px;
                text-decoration: none; padding: 10px 25px; border-radius: 5px;">
                Xem danh sách khóa học
            </a>
        </div>

        <p style="text-align: center; margin-top: 25px; color: #666; font-size: 14px;">
            Email này được gửi tự động, vui lòng không trả lời. <br>
            &copy; {{ date('Y') }} Online Emporium • <a href="#"
                style="color: #007bff; text-decoration: none;">www.example.com</a>
        </p>
    </div>
</body>

</html>
