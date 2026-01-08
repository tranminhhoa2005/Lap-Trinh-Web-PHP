<?php
require_once 'includes/auth.php';
require_login();
$products = [
    1 => ['name' => 'Laptop Dell', 'price' => 1500],
    2 => ['name' => 'Mouse RGB', 'price' => 25],
    3 => ['name' => 'Keyboard', 'price' => 50]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Sản phẩm</h2>
    <div class="row">
        <?php foreach($products as $id => $p): ?>
        <div class="col-md-4 card m-2 p-3">
            <h5><?=htmlspecialchars($p['name'])?></h5>
            <p>$<?=$p['price']?></p>
            <form method="POST"><input type="hidden" name="id" value="<?=$id?>">
                <button class="btn btn-success">Thêm vào giỏ</button></form>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="dashboard.php">Về Dashboard</a>
</body>
</html>