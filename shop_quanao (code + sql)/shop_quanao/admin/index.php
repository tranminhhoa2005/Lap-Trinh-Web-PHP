<?php 
include 'check_admin.php';
include '../config/db.php';

$total_products = $conn->query("SELECT id FROM products")->num_rows;
$total_orders = $conn->query("SELECT id FROM orders")->num_rows;
$revenue = $conn->query("SELECT SUM(total_price) as total FROM orders WHERE status = 2")->fetch_assoc();

$activities = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-2 sidebar">
                <h4 class="text-white">Admin ✨</h4>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item"><a class="nav-link active" href="index.php">🏠 Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_product.php">🎁 Thêm sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_products.php">📦 Quản lý kho</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_orders.php">🛒 Đơn hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_users.php">👥 Người dùng</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_subscribers.php"> ✉️ Thông báo tới thành viên</a></li>
                    <hr class="text-white mx-3">
                    <li class="nav-item"><a class="nav-link" href="../index.php">🌐 Xem Website</a></li>
                    <li class="nav-item"><a class="nav-link text-warning" href="../logout.php">🚪 Đăng xuất</a></li>
                </ul>
            </div>

            <div class="col-md-10 p-5">
                <h2 class="fw-bold mb-4">Chào mừng trở lại, Admin! 🌸</h2>
                
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-stat p-4 border-start border-5" style="border-color: #cdb4db !important; background-color: #cdb4db;">
            <h6 class="text-muted small fw-bold">TỔNG SẢN PHẨM</h6>
            <h2 class="fw-bold" style="color: #af87c9;"><?php echo $total_products; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stat p-4 border-start border-5" style="border-color: #ffafcc !important; background-color: #ffafcc;">
            <h6 class="text-muted small fw-bold">DOANH THU ĐÃ DUYỆT</h6>
            <h2 class="fw-bold" style="color: #ef476f;"><?php echo number_format($revenue['total'] ?? 0); ?>đ</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stat p-4 border-start border-5" style="border-color: #ffcaaf !important; background-color: #ffcaaf;">
            <h6 class="text-muted small fw-bold">ĐƠN HÀNG MỚI</h6>
            <h2 class="fw-bold" style="color: #f4a261;"><?php echo $total_orders; ?></h2>
        </div>
    </div>
</div>

                <div class="mt-5 table-container">
                    <h5 class="fw-bold mb-4">Hoạt động gần đây</h5>
                    <table class="table table-hover">
                        <thead style="background: #f0f0f0;">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($activities->num_rows > 0): ?>
                                <?php while($act = $activities->fetch_assoc()): ?>
                                <tr>
                                    <td><strong>#<?php echo $act['id']; ?></strong></td>
                                    <td><?php echo htmlspecialchars($act['fullname']); ?></td>
                                    <td style="color: #ef476f; font-weight: 700;"><?php echo number_format($act['total_price']); ?>đ</td>
                                    <td>
                                        <?php 
                                            if($act['status'] == 0) echo '<span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px;">🧁 Chờ duyệt</span>';
                                            elseif($act['status'] == 1) echo '<span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 5px;">📦 Đã xác nhận</span>';
                                            else echo '<span style="background: #d4edda; color: #2d6a4f; padding: 5px 10px; border-radius: 5px;">✅ Đã giao</span>';
                                        ?>
                                    </td>
                                    <td class="small text-muted"><?php echo date('d/m/Y H:i', strtotime($act['created_at'])); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center text-muted">Chưa có hoạt động nào</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>