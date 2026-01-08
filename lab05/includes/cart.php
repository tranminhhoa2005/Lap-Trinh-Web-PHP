<?php
require_once 'includes/auth.php';
require_login();
$products = [1 => ['name' => 'Laptop Dell', 'price' => 1500], 2 => ['name' => 'Mouse RGB', 'price' => 25], 3 => ['name' => 'Keyboard', 'price' => 50]];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach($_POST['qty'] as $id => $q) {
            if($q <= 0) unset($_SESSION['cart'][$id]);
            else $_SESSION['cart'][$id] = (int)$q;
        }
    } elseif (isset($_POST['del'])) {
        unset($_SESSION['cart'][$_POST['del']]);
    } elseif (isset($_POST['clear'])) {
        unset($_SESSION['cart']);
    }
    header("Location: cart.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Giỏ hàng</h2>
    <form method="POST">
    <table class="table">
        <tr><th>Tên</th><th>SL</th><th>Xóa</th></tr>
        <?php foreach(($_SESSION['cart'] ?? []) as $id => $qty): ?>
        <tr>
            <td><?=$products[$id]['name']?></td>
            <td><input type="number" name="qty[<?=$id?>]" value="<?=$qty?>" width="50"></td>
            <td><button name="del" value="<?=$id?>" class="btn btn-sm btn-danger">X</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <button name="update" class="btn btn-primary">Cập nhật</button>
    <button name="clear" class="btn btn-warning">Xóa sạch</button>
    </form>
    <br><a href="products.php">Tiếp tục mua hàng</a>
</body>
</html>