<?php 
include 'config/db.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-warning text-center mt-5'>
            <h5>Bạn cần đăng nhập để xem lịch sử đơn hàng!</h5>
            <a href='login.php' class='btn btn-primary mt-3'>Đăng nhập ngay</a>
          </div>";
    include 'includes/footer.php';
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase">Lịch sử đơn hàng của bạn</h2>
        <a href="index.php" class="btn btn-outline-secondary">← Tiếp tục mua sắm</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Người nhận</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result->num_rows > 0): ?>
                            <?php while($order = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">#<?php echo $order['id']; ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($order['created_at'])); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($order['fullname']); ?></strong><br>
                                    <small class="text-muted"><?php echo $order['phone']; ?></small>
                                </td>
                                <td>
                                    <span class="fw-bold text-danger"><?php echo number_format($order['total_price']); ?>đ</span>
                                </td>
                                <td>
                                    <?php 
                                    if($order['status'] == 0) {
                                        echo '<span class="badge bg-warning text-dark px-3 py-2">Đang chờ duyệt</span>';
                                    } elseif($order['status'] == 1) {
                                        echo '<span class="badge bg-info text-white px-3 py-2">Đang giao hàng</span>';
                                    } elseif($order['status'] == 2) {
                                        echo '<span class="badge bg-success px-3 py-2">Đã giao hàng</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary px-3 py-2">Đã hủy</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="80" class="mb-3 opacity-25">
                                    <p class="text-muted">Bạn chưa đặt đơn hàng nào!</p>
                                    <a href="index.php" class="btn btn-primary">Mua sản phẩm đầu tiên</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include 'includes/footer.php'; 
?>