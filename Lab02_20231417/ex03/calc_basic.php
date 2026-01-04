<?php
$a = 36;
$b = 18;

echo "Tổng: " . ($a + $b) . "<br>";
echo "Hiệu: " . ($a - $b) . "<br>";
echo "Tích: " . ($a * $b) . "<br>";
echo "Thương: " . ($a / $b) . "<br>";
echo "Chia lấy dư: " . ($a % $b) . "<br>";

// Nối chuỗi
$msg = "Kết quả phép tính";
$msg .= " của hai số $a và $b là:"; 
echo $msg . "<br>";

// So sánh
echo "So sánh '5' == 5: "; 
var_dump("5" == 5); // true vì chỉ so sánh giá trị
echo "<br>So sánh '5' === 5: "; 
var_dump("5" === 5); // false vì khác kiểu dữ liệu (string vs int)
?>