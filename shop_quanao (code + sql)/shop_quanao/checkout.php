<?php 
include 'config/db.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để đặt hàng!'); window.location='login.php';</script>";
    exit();
}

if (isset($_POST['order'])) {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total = $_POST['total_all'];

    $stmt = $conn->prepare("INSERT INTO orders (user_id, fullname, address, phone, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssd", $user_id, $fullname, $address, $phone, $total);
    
    if ($stmt->execute()) {
        $order_id = $conn->insert_id;
        unset($_SESSION['cart']);
        echo "<div class='alert alert-success'>Đặt hàng thành công! Mã đơn: #$order_id</div>";
        echo "<a href='index.php' class='btn btn-primary'>Về trang chủ</a>";
        exit();
    }
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="mb-4 text-center">Thông tin giao hàng</h3>
        <form method="POST" class="border p-4 bg-white rounded shadow-sm">
            <div class="mb-3">
                <label>Họ và tên người nhận</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Địa chỉ nhận hàng</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
            </div>
            <?php 
            $final_total = 0;
            foreach($_SESSION['cart'] as $id => $qty) {
                $p = $conn->query("SELECT price FROM products WHERE id = $id")->fetch_assoc();
                $final_total += $p['price'] * $qty;
            }
            ?>
            <input type="hidden" name="total_all" value="<?php echo $final_total; ?>">
            <button type="submit" name="order" class="btn btn-danger btn-lg w-100">XÁC NHẬN ĐẶT HÀNG (<?php echo number_format($final_total); ?>đ)</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>