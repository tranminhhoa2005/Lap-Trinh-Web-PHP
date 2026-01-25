# Dự án Quản lý nhân viên (MVC PHP)
## 1. Hướng dẫn cài đặt và chạy
1. **Import Database:**
   - Mở phpMyAdmin (hoặc công cụ quản lý SQL khác).
   - Tạo database mới tên là `employee_management`.
   - Import file `database.sql` kèm theo trong thư mục này.

2. **Cấu hình kết nối:**
   - Mở file `config/database.php`.
   - Chỉnh sửa các thông số `user` và `pass` phù hợp với cấu hình MySQL trên máy của bạn (thường là `root` và mật khẩu trống).

3. **Cách chạy dự án:**
   - Truy cập theo đường dẫn: 
     http://localhost/lab12_mvc-crud/public/index.php?c=employee&a=index

## 3. Cấu trúc thư mục
- app/: Chứa mã nguồn MVC (Models, Views, Controllers).
- core/: Chứa các file hệ thống (Database, Router, Controller gốc).
- public/: Điểm truy cập duy nhất của ứng dụng.
- config/: Chứa file cấu hình hệ thống.