# Hệ thống website khóa học trực tuyến

## Giới thiệu

Đây là dự án website e-learning xây dựng bằng Laravel, phục vụ quản lý khóa học trực tuyến. Hệ thống có 2 khu vực chính:

- Khu vực quản trị: quản lý người dùng, khóa học, bài học, quiz, đơn hàng.
- Khu vực học viên: xem khóa học, đăng ký, thanh toán và học bài.

## Chức năng chính

### Khu vực quản trị

- Đăng nhập/đăng xuất.
- Dashboard: thống kê học viên, khóa học, đơn hàng, doanh thu.
- Quản lý người dùng, vai trò, phân quyền.
- Quản lý giảng viên, danh mục khóa học, khóa học, bài học.
- Quản lý quiz, câu hỏi, đáp án.
- Quản lý ghi danh, thảo luận, tin nhắn.

### Khu vực học viên

- Xem khóa học, giảng viên, danh mục nổi bật.
- Tìm kiếm và xem chi tiết khóa học.
- Đăng ký/đăng nhập.
- Thêm khóa học vào giỏ hàng, checkout, thanh toán VietQR.
- Học khóa học đã đăng ký và làm bài kiểm tra.

## Công nghệ sử dụng

- PHP ^8.1, Laravel ^10
- MySQL/MariaDB
- Blade, Bootstrap, jQuery
- Laravel Sanctum, Toastr
- Vite (chủ yếu dùng public/)

## Cài đặt

1. Cài dependency PHP:

```bash
composer install
```

2. Tạo file môi trường

```bash
copy .env.example .env      # Windows
# hoặc
cp .env.example .env         # Mac/Linux

php artisan key:generate
```

- Chỉnh các thông tin database trong `.env`:

```env
APP_NAME="Khoa hoc online"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_elearning
DB_USERNAME=root
DB_PASSWORD=
```

3. Chuẩn bị database

#### Cách A: Dùng migration + seed

```bash
php artisan migrate
php artisan db:seed
```

#### Cách B: Import dữ liệu mẫu SQL

- Import file `database/sql db/laravel_elearning.sql` vào MySQL/MariaDB.
- Sau đó chạy thêm migration:

```bash
php artisan migrate
```

4. Chạy project

```bash
php artisan serve
```

- Truy cập:
    - Trang người dùng: `http://127.0.0.1:8000/`
