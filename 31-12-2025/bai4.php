<?php
if (isset($_GET['a']) && isset($_GET['b'])){
    $a = (int)$_GET['a'];
    $b = (int)$_GET['b'];
    $tong = $a + $b;
    $hieu = $a - $b;
    $tich = $a * $b;
    if ($b != 0) {
        $chia = $a / $b;
        echo "Thương của $a và $b là: " . $chia . "<br>";
    } else {
        echo "Không thể chia cho 0!<br>";
    }

    echo "Tổng của $a và $b là: " . $tong;
    echo "<br>Hiệu của $a và $b là: " . $hieu;
    echo "<br>Tích của $a và $b là: " . $tich;
} else {
    echo "Vui lòng cung cấp tham số a và b trên URL. Ví dụ: bai4.php?a=5&b=10";
}
?>
