<?php
header("Content-Type: application/json");
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$product = new Product($db);

$id = $_POST['id'] ?? null;
$code = $_POST['code'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? 0;

if (empty($code) || empty($name)) {
    echo json_encode([
        "success" => false,
        "message" => "Vui lòng nhập đầy đủ mã và tên sản phẩm",
        "data" => null
    ]);
    exit;
}

try {
    if ($id) {
        $res = $product->update($id, $code, $name, $price);
        $msg = "Cập nhật sản phẩm thành công";
    } else {
        $res = $product->create($code, $name, $price);
        $msg = "Thêm sản phẩm mới thành công";
    }

    echo json_encode([
        "success" => $res,
        "message" => $res ? $msg : "Không có thay đổi nào được thực hiện",
        "data" => ["id" => $id]
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi hệ thống: " . $e->getMessage(),
        "data" => null
    ]);
}