<?php
    $chuoi = "Xin chào, tôi là Trần Minh Hòa";
    $so_nguyen = 18;
    $so_thuc = 3.6;
    $dung_sai = true;
    $mang = array("PHP", "MySQL", "JavaScript");

    echo "<h2>Kiểu dữ liệu trong PHP</h2>";
    echo "Chuỗi: " . $chuoi . "<br>";
    echo "Số nguyên: " . $so_nguyen . "<br>";
    echo "Số thực: " . $so_thuc . "<br>";
    echo "đúng sai: " . ($dung_sai ? 'true' : 'false') . "<br>";
    echo "Mảng: " . implode(", ", $mang) . "<br>";
?>