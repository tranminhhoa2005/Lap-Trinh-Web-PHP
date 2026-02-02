<?php 
include 'check_admin.php';
include '../config/db.php';

if(isset($_GET['confirm'])) {
    $id = intval($_GET['confirm']);
    $conn->query("UPDATE orders SET status = 1 WHERE id = $id");
    header("Location: manage_orders.php?msg=confirmed");
    exit();
}

if(isset($_GET['deliver'])) {
    $id = intval($_GET['deliver']);
    $conn->query("UPDATE orders SET status = 2 WHERE id = $id");
    header("Location: manage_orders.php?msg=delivered");
    exit();
}

$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng ✨ MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink-primary: #ff85a2;
            --pink-soft: #fbe4e9;
            --peach: #ffcaaf;
            --mint: #b9fbc0;
        }

        body { 
            background: #fff5f7; 
            font-family: 'Quicksand', sans-serif; 
            color: #4a4a4a;
        }

        .container { max-width: 1000px; }

        /* Card tổng thể */
        .order-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(255, 133, 162, 0.1);
            border: none;
            overflow: hidden;
            margin-top: 20px;
        }

        /* Tiêu đề bảng */
        .table thead {
            background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%);
            color: white;
            border: none;
        }

        .table thead th {
            padding: 20px;
            font-weight: 700;
            border: none;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        /* Dòng trong bảng */
        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background-color: #fff9fa;
            transform: scale(1.01);
        }

        .table td {
            padding: 20px;
            border-bottom: 1px solid #fbe4e9;
            vertical-align: middle;
        }

        /* Badge trạng thái */
        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.75rem;
        }

        .bg-wait { background: var(--peach); color: #d35400; }
        .bg-done { background: var(--mint); color: #2d6a4f; }

        /* Nút xác nhận */
        .btn-confirm {
            background: var(--pink-primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 4px 10px rgba(255, 133, 162, 0.3);
            transition: 0.3s;
        }

        .btn-confirm:hover {
            background: #ef476f;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 71, 111, 0.4);
        }

        .price-tag {
            color: #ef476f;
            font-weight: 800;
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold m-0" style="color: #ef476f;">Đơn hàng của bé 🎀</h2>
            <p class="text-muted small">Cùng duyệt những đơn hàng mới nhất nào!</p>
        </div>
        <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">🏠 Dashboard</a>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            <?php 
                if($_GET['msg'] == 'confirmed') echo '🎉 Đơn hàng đã được xác nhận. Vui lòng giao hàng!';
                elseif($_GET['msg'] == 'delivered') echo '✅ Tuyệt vời! Đơn hàng đã được giao thành công.';
            ?>
        </div>
    <?php endif; ?>

    <div class="order-container shadow">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($orders->num_rows > 0): ?>
                        <?php while($row = $orders->fetch_assoc()): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#<?php echo $row['id']; ?></td>
                            <td>
                                <div class="fw-bold" style="color: #4a4a4a;"><?php echo htmlspecialchars($row['fullname']); ?></div>
                                <div class="small text-muted">📞 <?php echo $row['phone']; ?></div>
                            </td>
                            <td>
                                <div class="small text-truncate" style="max-width: 200px;" title="<?php echo $row['address']; ?>">
                                    📍 <?php echo htmlspecialchars($row['address']); ?>
                                </div>
                            </td>
                            <td><span class="price-tag"><?php echo number_format($row['total_price']); ?>đ</span></td>
                            <td>
                                <?php if($row['status'] == 0): ?>
                                    <span class="badge-status bg-wait">🧁 Chờ duyệt</span>
                                <?php elseif($row['status'] == 1): ?>
                                    <span class="badge-status" style="background: #fff3cd; color: #856404;">📦 Đã xác nhận</span>
                                <?php else: ?>
                                    <span class="badge-status bg-done">✅ Đã giao</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($row['status'] == 0): ?>
                                    <a href="?confirm=<?php echo $row['id']; ?>" class="btn btn-confirm">Xác nhận ✨</a>
                                <?php elseif($row['status'] == 1): ?>
                                    <a href="?deliver=<?php echo $row['id']; ?>" class="btn btn-confirm" style="background: #20c997;">Giao hàng ✅</a>
                                <?php else: ?>
                                    <span class="text-muted small fst-italic">Hoàn tất</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <p class="text-muted">Chưa có đơn hàng nào đâu bạn ơi! 🍭</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>