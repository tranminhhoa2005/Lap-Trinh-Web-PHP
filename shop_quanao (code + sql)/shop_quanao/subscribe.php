<?php
header('Content-Type: application/json');

require 'config/db.php';

$create_table = "CREATE TABLE IF NOT EXISTS subscribers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($create_table);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    if (empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập email!']);
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email không hợp lệ!']);
        exit();
    }
    
    $check_sql = "SELECT id FROM subscribers WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email này đã đăng ký rồi!']);
        exit();
    }
    
    $insert_sql = "INSERT INTO subscribers (email, created_at) VALUES (?, NOW())";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("s", $email);
    
    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Đăng ký thành công! 🎉']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra, vui lòng thử lại!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
