<?php
require_once 'includes/auth.php';
require_once 'includes/flash.php';
require_once 'includes/csrf.php';
require_login();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <?php if($f = get_flash('success')) echo "<div class='alert alert-success'>$f</div>"; ?>
    <h1>Chào, <?=htmlspecialchars($_SESSION['user']['username'])?></h1>
    <p>Quyền: <strong><?=htmlspecialchars($_SESSION['user']['role'])?></strong></p>

    <?php if($_SESSION['user']['role'] === 'admin'): ?>
        <div class="alert alert-warning"><strong>Admin Panel:</strong> Chỉ Admin mới thấy mục này.</div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="products.php" class="btn btn-info">Mua sắm</a>
        <form action="logout.php" method="POST" class="d-inline">
            <input type="hidden" name="csrf" value="<?=csrf_token()?>">
            <button class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>
</body>
</html>