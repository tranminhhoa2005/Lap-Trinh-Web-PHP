<?php
// Lấy dữ liệu từ URL, mặc định a=0, b=0 và phép tính là cộng
$a  = (float)($_GET["a"] ?? 0);
$b  = (float)($_GET["b"] ?? 0);
$op = $_GET["op"] ?? "add"; 

$result = null;
$error  = null;

// TODO: switch-case xử lý các phép tính
switch ($op) {
    case 'add':
        $result = $a + $b;
        $label  = "Cộng";
        break;
    case 'sub':
        $result = $a - $b;
        $label  = "Trừ";
        break;
    case 'mul':
        $result = $a * $b;
        $label  = "Nhân";
        break;
    case 'div':
        // Kiểm tra chia cho 0
        if ($b == 0) {
            $error = "Lỗi: Không thể chia cho 0!";
        } else {
            $result = $a / $b;
            $label  = "Chia";
        }
        break;
    default:
        $error = "Phép tính không hợp lệ!";
}

// Hiển thị kết quả
echo "<h3>Máy tính đơn giản</h3>";
if ($error) {
    echo "<p style='color:red;'>$error</p>";
} else {
    echo "Phép tính: <strong>$label</strong><br>";
    echo "Kết quả: $a " . ($op == 'div' ? '/' : ($op == 'mul' ? '*' : ($op == 'sub' ? '-' : '+'))) . " $b = <strong>$result</strong>";
}
?>