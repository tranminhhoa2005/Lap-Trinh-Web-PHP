<?php
require_once 'includes/auth.php';
require_once 'includes/flash.php';
require_once 'includes/users.php';

if (is_logged_in()) header('Location: dashboard.php');

$error = '';
$rem_user = $_COOKIE['remember_username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    if (isset($users[$username]) && password_verify($password, $users[$username]['hash'])) {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = ['username' => $username, 'role' => $users[$username]['role']];
        
        if (!empty($_POST['remember'])) {
            setcookie('remember_username', $username, time() + 7*24*60*60, '/');
        } else {
            setcookie('remember_username', '', time() - 3600, '/');
        }

        write_log($username, "LOGIN");
        set_flash('success', 'Đăng nhập thành công!');
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Sai tài khoản hoặc mật khẩu.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 card p-4 shadow">
            <h3 class="text-center">Đăng nhập</h3>
            <?php if($f = get_flash('info')) echo "<div class='alert alert-info'>$f</div>"; ?>
            <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
                <input type="text" name="username" class="form-control mb-3" value="<?=htmlspecialchars($rem_user)?>" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <label class="mb-3"><input type="checkbox" name="remember" <?=$rem_user?'checked':''?>> Remember me</label>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>