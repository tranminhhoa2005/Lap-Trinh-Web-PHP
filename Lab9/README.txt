===========================================================
BÀI TẬP THỰC HÀNH: MINI WEBSITE QUẢN LÝ SINH VIÊN (PHP MVC)
Sinh viên thực hiện: Nguyễn Văn Dũng
Mã số sinh viên  : 20231619
===========================================================

1. MÔ TẢ HỆ THỐNG
- Website quản lý sinh viên sử dụng mô hình MVC (Model-View-Controller).
- Kết nối cơ sở dữ liệu qua PDO, đảm bảo bảo mật bằng Prepare/Execute.
- Toàn bộ thao tác Thêm, Sửa, Xóa, Liệt kê được thực hiện qua Ajax (Jquery).
- Không load lại trang (Single Page Experience) khi thao tác dữ liệu.
- Phản hồi dữ liệu từ Server dưới dạng JSON chuẩn.

2. CẤU HÌNH CƠ SỞ DỮ LIỆU
- Bước 1: Mở phpMyAdmin và tạo database tên là: it3220_php
- Bước 2: Import file SQL tại đường dẫn: /database/it3220_php.sql
- Bước 3: Cấu hình thông số kết nối tại file: /app/config/db.php
    + Host: localhost
    + DB Name: it3220_php
    + User: root
    + Password: (Để trống - mặc định của XAMPP)
    + Charset: utf8mb4

3. HƯỚNG DẪN CHẠY ỨNG DỤNG
- Bước 1: Sao chép thư mục đồ án vào thư mục 'htdocs' của XAMPP.
- Bước 2: Khởi động Apache và MySQL trong XAMPP Control Panel.
- Bước 3: Truy cập vào trình duyệt theo đường dẫn (URL):
    http://localhost/lab09/public/index.php

- Bước 4: Có thể kiểm tra kết nối DB nhanh tại:
    http://localhost/Labs/Lab9/public/