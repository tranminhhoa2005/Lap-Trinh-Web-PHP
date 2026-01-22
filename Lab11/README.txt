======================================================================
BÀI TẬP LAB 11 - PHP CRUD CƠ BẢN (PDO)
TOPIC 1: QUẢN LÝ DANH MỤC (CATEGORIES)
----------------------------------------------------------------------
Sinh viên thực hiện: Trần Minh Hòa
Mã sinh viên:        20231417
Lớp:                 DCCNTT14.4
======================================================================

1. YÊU CẦU HỆ THỐNG
-------------------
- XAMPP (khuyên dùng) hoặc Laragon.
- PHP phiên bản 7.4 hoặc 8.x.
- MySQL Database.

2. HƯỚNG DẪN CÀI ĐẶT & CẤU HÌNH
-------------------
Bước 1: Cấu hình Cơ sở dữ liệu (Database)
   - Mở phpMyAdmin (thường là http://localhost/phpmyadmin).
   - Tạo một database mới tên là: lab11_categories
   - Nhấn vào tab "Import", chọn file "database.sql" có trong thư mục này và nhấn "Go" (Thực hiện).
   - Hoặc chạy câu lệnh SQL trong file database.sql tại tab "SQL".

Bước 2: Cấu hình code
   - Copy thư mục code vào thư mục htdocs của XAMPP (VD: C:\xampp\htdocs\Lab11).
   - Mở file "db.php" (nếu có) hoặc kiểm tra phần đầu các file php để cấu hình thông số kết nối:
     + $host = 'localhost';
     + $dbname = 'lab11_categories';
     + $username = 'root';
     + $password = ''; (Mặc định XAMPP là rỗng, nếu dùng MAMP là 'root').

3. HƯỚNG DẪN SỬ DỤNG
-------------------
- Truy cập trình duyệt theo đường dẫn: 
  http://localhost/Labs/Lab11/index.php

- Chức năng:
  + Xem danh sách: Hiển thị bảng danh mục.
  + Tìm kiếm: Nhập tên hoặc slug vào ô tìm kiếm -> Enter.
  + Thêm mới: Bấm nút "Thêm mới", nhập thông tin (có validate).
  + Sửa: Bấm "Edit" tương ứng với dòng dữ liệu.
  + Xóa: Bấm "Delete", sẽ có hộp thoại xác nhận (Confirm) hiện ra.

4. DANH SÁCH FILE
-------------------
- db.php:        File kết nối CSDL sử dụng PDO.
- index.php:     Trang chủ, hiển thị danh sách và tìm kiếm.
- create.php:    Trang thêm mới danh mục.
- edit.php:      Trang cập nhật danh mục.
- delete.php:    Xử lý xóa danh mục.
- database.sql:  Script tạo bảng và dữ liệu mẫu.
- README.txt:    Hướng dẫn sử dụng.

======================================================================