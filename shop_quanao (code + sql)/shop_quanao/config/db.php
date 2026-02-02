<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "shop_quanao";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>