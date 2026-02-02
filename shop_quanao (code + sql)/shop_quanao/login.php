<?php
session_start();
require 'config/db.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($pass, $row['password'])) {
        $_SESSION['user'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role']; // 1 là admin, 0 là khách

        if($row['role'] == 1) {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        $error = "Sai thông tin rồi bạn ơi!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - THE FASHION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff85a2 0%, #ffd166 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Quicksand', sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(255, 133, 162, 0.3);
            padding: 50px 40px;
            max-width: 420px;
            width: 100%;
            border: 3px solid #fbe4e9;
        }
        .login-title {
            font-family: 'Pacifico', cursive;
            color: #ef476f;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .login-subtitle {
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
        .btn-login {
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
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 71, 111, 0.4);
            color: white;
        }
        .divider {
            text-align: center;
            margin: 25px 0;
            color: #999;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #ff85a2;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .register-link a:hover {
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
    <div class="login-container">
        <div class="login-title">👕 THE FASHION</div>
        <div class="login-subtitle">Chào em đến với thế giới thời trang! ✨</div>
        
        <?php if(isset($error)) echo "<div class='alert alert-danger' role='alert'>$error</div>"; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">👤 Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="mb-3">
                <label class="form-label">🔐 Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" name="login" class="btn btn-login w-100">✨ Đăng Nhập Ngay</button>
        </form>
        
        <div class="register-link">
            <p class="mb-0">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        </div>
        
        <div class="back-home">
            <a href="index.php">← Quay về trang chủ</a>
        </div>
    </div>
</body>
</html>