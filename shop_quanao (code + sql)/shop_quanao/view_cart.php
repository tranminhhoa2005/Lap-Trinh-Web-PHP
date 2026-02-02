<?php 
include 'config/db.php';
include 'includes/header.php';

$total_all = 0;
?>

<h2 class="mb-4">Giỏ hàng của bạn</h2>
<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $qty): 
                $res = $conn->query("SELECT * FROM products WHERE id = $id");
                $p = $res->fetch_assoc();
                $subtotal = $p['price'] * $qty;
                $total_all += $subtotal;
            ?>
            <tr>
                <td>
                    <img src="images/<?php echo $p['image']; ?>" width="50" class="me-2">
                    <?php echo $p['name']; ?>
                </td>
                <td><?php echo number_format($p['price']); ?>đ</td>
                <td><?php echo $qty; ?></td>
                <td class="fw-bold text-danger"><?php echo number_format($subtotal); ?>đ</td>
                <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-sm btn-outline-danger">Xóa</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                <td colspan="2" class="fw-bold text-danger fs-5"><?php echo number_format($total_all); ?>đ</td>
            </tr>
        <?php else: ?>
            <tr><td colspan="5" class="text-center">Giỏ hàng trống trơn à!</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between">
    <a href="index.php" class="btn btn-secondary">Tiếp tục mua sắm</a>
    <?php if (!empty($_SESSION['cart'])): ?>
        <a href="checkout.php" class="btn btn-success btn-lg">Tiến hành thanh toán</a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>