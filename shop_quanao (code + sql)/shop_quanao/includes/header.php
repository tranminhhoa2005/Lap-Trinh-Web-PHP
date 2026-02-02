<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Shop - Sinh viên Hà Nội</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .product-card { transition: transform 0.2s; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .product-card:hover { transform: translateY(-5px); }
        footer { background: #343a40; color: white; padding: 30px 0; margin-top: 50px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php text-uppercase">👕 THE FASHION</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?tag=Hot">Bán chạy</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?tag=Sale">Giảm giá</a></li>
            </ul>

            <form class="d-flex mx-auto" action="index.php" method="GET" style="width: 40%;">
                <input class="form-control me-2" type="search" name="search" placeholder="Tìm tên quần áo...">
                <button class="btn btn-outline-light" type="submit">Tìm</button>
            </form>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="view_cart.php">
                        Giỏ hàng 🛒
                        <?php if(!empty($_SESSION['cart'])): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo count($_SESSION['cart']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Chào, <?php echo $_SESSION['user']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="my_orders.php">Đơn hàng của tôi</a></li>
                            <?php if($_SESSION['role'] == 1): ?>
                                <li><a class="dropdown-item text-primary fw-bold" href="admin/index.php">Quản trị viên</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">