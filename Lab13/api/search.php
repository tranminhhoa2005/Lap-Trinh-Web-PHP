<?php
header("Content-Type: application/json");
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$product = new Product($db);
$q = $_GET['q'] ?? '';

try {
    $results = $product->search($q);
    echo json_encode([
        "success" => true,
        "message" => "Lấy danh sách thành công",
        "data" => $results
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi: " . $e->getMessage(),
        "data" => null
    ]);
}