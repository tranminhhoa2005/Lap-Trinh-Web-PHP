<?php 
include 'config/db.php';
include 'includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();

if (!$p) {
    echo "<div class='alert alert-danger'>Sản phẩm không tồn tại!</div>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="row mt-4">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <img src="images/<?php echo $p['image']; ?>" class="img-fluid rounded shadow-sm" alt="<?php echo $p['name']; ?>">
        </div>
    </div>
    <div class="col-md-7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active"><?php echo $p['tag']; ?></li>
            </ol>
        </nav>
        <h1 class="display-5 fw-bold"><?php echo $p['name']; ?></h1>
        <p class="badge bg-danger fs-6"><?php echo $p['tag']; ?></p>
        <h3 class="text-danger my-3"><?php echo number_format($p['price']); ?> VNĐ</h3>
        <hr>
        <h5>Mô tả sản phẩm:</h5>
        <p class="text-muted leading-relaxed"><?php echo nl2br($p['description']); ?></p>
        <p><strong>Tình trạng:</strong> <?php echo ($p['stock_quantity'] > 0) ? "Còn hàng (".$p['stock_quantity'].")" : "<span class='text-danger'>Hết hàng</span>"; ?></p>
        
        <?php if($p['stock_quantity'] > 0): ?>
        <form action="cart.php" method="POST" class="d-flex gap-2 align-items-center mt-4">
            <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
            <div style="width: 100px;">
                <label class="small text-muted">Số lượng:</label>
                <input type="number" name="qty" class="form-control" value="1" min="1" max="<?php echo $p['stock_quantity']; ?>">
            </div>
            <button class="btn btn-dark btn-lg px-5 mt-4" type="submit" name="add">
                THÊM VÀO GIỎ
            </button>
        </form>
        <?php endif; ?>
    </div>
</div>

<div class="mt-5 p-4 bg-light rounded">
    <h4>Chính sách bán hàng</h4>
    <ul class="text-muted small">
        <li>Giao hàng toàn quốc từ 2-4 ngày.</li>
        <li>Kiểm tra hàng trước khi thanh toán.</li>
        <li>Đổi trả trong vòng 7 ngày nếu có lỗi từ nhà sản xuất.</li>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>