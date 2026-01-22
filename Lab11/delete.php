<?php
// --- NHÚNG KẾT NỐI CSDL TRỰC TIẾP ---
$host = 'localhost';
$dbname = 'lab11_categories'; 
$username = 'root';
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}
// ------------------------------------

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Thực hiện xóa
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    if ($stmt->execute(['id' => $id])) {
        $_SESSION['success'] = "Đã xóa danh mục ID: " . htmlspecialchars($id);
    } else {
        $_SESSION['error'] = "Xóa thất bại.";
    }
}

header('Location: index.php');
exit;
?>