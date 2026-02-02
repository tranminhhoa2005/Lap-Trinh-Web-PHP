<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'config/db.php'; 

$msg = "";
$type = "";

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];

    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $user);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        $msg = "Tên đăng nhập này đã có người sử dụng!";
        $type = "danger";
    } else {
        $pass_hashed = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("sss", $user, $pass_hashed, $email);
        
        if ($stmt->execute()) {
            $msg = "Đăng ký thành công! Đang chuyển hướng...";
            $type = "success";
            header("refresh:2;url=login.php");
        } else {
            $msg = "Lỗi hệ thống, vui lòng thử lại!";
            $type = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên - THE FASHION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffd166 0%, #ff85a2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Quicksand', sans-serif;
            padding: 20px;
        }
        .register-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(255, 133, 162, 0.3);
            padding: 50px 40px;
            max-width: 450px;
            width: 100%;
            border: 3px solid #fbe4e9;
        }
        .register-title {
            font-family: 'Pacifico', cursive;
            color: #ef476f;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .register-subtitle {
            text-align: center;
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 15px;
            border: 2px solid #fbe4e9;
            padding: 12px 20px;
            background: #fff9fa;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff85a2;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 133, 162, 0.25);
        }
        .form-label {
            font-weight: 600;
            color: #ef476f;
            margin-bottom: 8px;
        }
        .btn-register {
            background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%);
            border: none;
            border-radius: 15px;
            padding: 12px 20px;
            font-weight: 700;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(239, 71, 111, 0.3);
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 71, 111, 0.4);
            color: white;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #ff85a2;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .login-link a:hover {
            color: #ef476f;
            text-decoration: underline;
        }
        .back-home {
            text-align: center;
            margin-top: 15px;
        }
        .back-home a {
            color: #999;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .back-home a:hover {
            color: #ef476f;
        }
        .alert {
            border-radius: 15px;
            border: none;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-title">👕 THE FASHION</div>
        <div class="register-subtitle">Cùng gia nhập gia đình tiểu thư xinh xắn! 🌸</div>
        
        <?php if($msg != ""): ?>
            <div class="alert alert-<?php echo $type; ?>" role="alert"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">👤 Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" placeholder="Ví dụ: tiểu_thư_2026" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📧 Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">🔐 Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Ít nhất 6 ký tự" required>
            </div>
            <button type="submit" name="register" class="btn btn-register w-100 py-2">✨ Đăng Ký Ngay Thôi</button>
        </form>
        
        <div class="login-link">
            <p class="mb-0">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
        </div>
        
        <div class="back-home">
            <a href="index.php">← Quay về trang chủ</a>
        </div>
    </div>
</body>
</html>