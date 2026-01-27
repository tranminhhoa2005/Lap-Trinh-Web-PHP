
## Hướng dẫn cài đặt
1. **Cơ sở dữ liệu:**
   - Mở phpMyAdmin và tạo database tên: `inventory_db`.
   - Import file `sql/db.sql` vào database vừa tạo.
2. **Cấu hình kết nối:**
   - Mở file `config/database.php`.
   - Chỉnh sửa thông số `$username` và `$password` nếu bạn thay đổi cấu hình mặc định của XAMPP/Laragon.
3. **Chạy ứng dụng:**
    - Truy cập trình duyệt theo đường dẫn: `http://localhost/lab13/views/index.php`.

## Danh sách API (Endpoint)
- **Search (GET):** `/api/search.php?q=keyword`
- **Save (POST):** `/api/save.php` (Dùng cho cả Add và Update)
- **Delete (POST):** `/api/delete.php` (Body: `id=...`)