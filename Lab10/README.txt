THÔNG TIN SINH VIÊN
-------------------
Họ tên: Trần Minh Hòa
MSSV:   20231417
Lớp:    DCCNTT.14.4
Bài tập: Lab 10 - Xây dựng ứng dụng PHP MVC (Chủ đề C: Quản lý Nhân sự)

HƯỚNG DẪN CÀI ĐẶT
-----------------
1. Cấu hình Database:
   - Mở phpMyAdmin, Import file 'db_lab10.sql' kèm theo.
   - Hoặc tạo DB tên 'lab10_hr' và chạy lệnh SQL trong file đó.

2. Cấu hình User (Bắt buộc):
   - Ứng dụng sử dụng user riêng để bảo mật.
   - User: 'lab_user'
   - Pass: '2808'
   - Nếu chưa có user này, chạy lệnh SQL sau trong phpMyAdmin:
     CREATE USER 'lab_user'@'localhost' IDENTIFIED BY '2808';
     GRANT ALL PRIVILEGES ON lab10_hr.* TO 'lab_user'@'localhost';
     FLUSH PRIVILEGES;

3. Cấu hình Source Code:
   - Copy thư mục code vào 'C:\xampp\htdocs\lab10_hr'.
   - Kiểm tra file 'app/config/db.php' đảm bảo thông tin kết nối đúng.

4. Cách chạy:
   - Mở trình duyệt truy cập: http://localhost/lab10_hr/public/index.php
   - Trang chủ mặc định là danh sách nhân viên.

CHỨC NĂNG ĐÃ HOÀN THÀNH
-----------------------
1. CRUD Phòng ban (Departments).
2. CRUD Nhân viên (Employees).
3. Tìm kiếm, Lọc theo phòng ban, Sắp xếp (whitelist).
4. Ràng buộc nghiệp vụ: Không cho xóa phòng ban nếu còn nhân viên.
5. Bảo mật: Chống SQL Injection bằng PDO Prepared Statements.