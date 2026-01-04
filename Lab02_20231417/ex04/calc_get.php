<?php
if (!isset($_GET['a']) || !isset($_GET['b']) || !isset($_GET['op'])) {
    echo "Hướng dẫn sử dụng: ?a=10&b=5&op=add (op có thể là add, sub, mul, div)";
} else {
    $a = (float)$_GET['a'];
    $b = (float)$_GET['b'];
    $op = $_GET['op'];
    $res = 0;
    $valid = true;

    switch ($op) {
        case 'add': $res = $a + $b; $symbol = '+'; break;
        case 'sub': $res = $a - $b; $symbol = '-'; break;
        case 'mul': $res = $a * $b; $symbol = '*'; break;
        case 'div':
            if ($b == 0) {
                echo "Lỗi: Không thể chia cho 0";
                $valid = false;
            } else {
                $res = $a / $b;
                $symbol = '/';
            }
            break;
        default:
            echo "Phép tính không hợp lệ";
            $valid = false;
    }

    if ($valid) echo "$a $symbol $b = $res";
}
?>