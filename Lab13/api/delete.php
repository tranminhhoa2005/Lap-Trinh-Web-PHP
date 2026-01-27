<?php
header("Content-Type: application/json");
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$product = new Product($db);
$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode([
        "success" => false,
        "message" => "ID không hợp lệ",
        "data" => null
    ]);
    exit;
}

try {
    $res = $product->delete($id);
    echo json_encode([
        "success" => $res,
        "message" => $res ? "Xóa thành công" : "Sản phẩm không tồn tại hoặc đã bị xóa trước đó",
        "data" => null
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi: " . $e->getMessage(),
        "data" => null
    ]);
}