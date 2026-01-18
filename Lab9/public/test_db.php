<?php
// Bật hiển thị lỗi để dễ debug nếu file không chạy được
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Import file Database Core
// Vì file này nằm trong thư mục /public, ta cần lui lại 1 cấp (..) để vào thư mục app
require_once __DIR__ . '/../app/core/Database.php';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra kết nối CSDL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h2 { margin-top: 0; color: #333; }
        .status { margin: 20px 0; padding: 15px; border-radius: 5px; }
        .success { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .error { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn:hover { background-color: #0b5ed7; }
    </style>
</head>
<body>

<div class="container">
    <h2>DB Connection Test</h2>
    
    <?php
    try {
        // 2. Gọi hàm connect() từ class Database
        $conn = Database::connect();

        // 3. Thực hiện truy vấn mẫu: Đếm số lượng sinh viên
        $stmt = $conn->query("SELECT COUNT(*) as total FROM students");
        $result = $stmt->fetch();

        // 4. Nếu code chạy đến đây nghĩa là thành công
        ?>
        <div class="status success">
            <h4>✅ Kết nối thành công!</h4>
            <p>Database: <strong><?php echo DB_NAME; ?></strong></p>
            <p>Tổng số bản ghi trong bảng <code>students</code>: <strong><?php echo $result['total']; ?></strong></p>
        </div>
        
        <a href="index.php" class="btn">Đi đến Trang chủ</a>
        
    <?php
    } catch (Exception $e) {
        // 5. Bắt lỗi nếu kết nối thất bại
        ?>
        <div class="status error">
            <h4>❌ Kết nối thất bại!</h4>
            <p><strong>Lỗi:</strong> <?php echo $e->getMessage(); ?></p>
            <hr>
            <small style="text-align: left; display: block;">
                Gợi ý kiểm tra:<br>
                1. Tên database trong file <code>config/db.php</code> đã đúng chưa?<br>
                2. User/Password của MySQL (mặc định XAMPP là root / rỗng).<br>
                3. MySQL server đã được bật (Start) chưa?
            </small>
        </div>
    <?php
    }
    ?>
</div>

</body>
</html>