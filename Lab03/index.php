<?php
require_once "functions.php";

$action = $_GET["action"] ?? "home";

echo "<h2>LAB03 - Mini Utility</h2>";
echo "<p>
<a href='?action=max&a=10&b=22'>Max</a> |
<a href='?action=min&a=10&b=22'>Min</a> |
<a href='?action=prime&n=17'>Prime</a> |
<a href='?action=fact&n=6'>Factorial</a> |
<a href='?action=gcd&a=12&b=18'>GCD</a>
</p>";

// Lấy các tham số từ URL
$a = isset($_GET["a"]) ? (int)$_GET["a"] : 0;
$b = isset($_GET["b"]) ? (int)$_GET["b"] : 0;
$n = isset($_GET["n"]) ? (int)$_GET["n"] : 0;

echo "<div style='padding: 10px; border: 1px solid #ccc; background: #f9f9f9;'>";

switch ($action) {
    case 'max':
        echo "Số lớn nhất giữa $a và $b là: <strong>" . max2($a, $b) . "</strong>";
        break;

    case 'min':
        echo "Số nhỏ nhất giữa $a và $b là: <strong>" . min2($a, $b) . "</strong>";
        break;

    case 'prime':
        $check = isPrime($n) ? "là số nguyên tố" : "không phải là số nguyên tố";
        echo "Số $n <strong>$check</strong>.";
        break;

    case 'fact':
        $res = factorial($n);
        if ($res === null) {
            echo "<span style='color:red;'>Lỗi: Không tính được giai thừa của số âm ($n).</span>";
        } else {
            echo "Giai thừa của $n ($n!) = <strong>$res</strong>";
        }
        break;

    case 'gcd':
        echo "Ước chung lớn nhất của $a và $b là: <strong>" . gcd($a, $b) . "</strong>";
        break;

    case 'home':
        echo "Chào mừng bạn! Hãy chọn một chức năng ở trên để thực hiện.";
        break;

    default:
        echo "Hành động không hợp lệ!";
        break;
}

echo "</div>";
?>