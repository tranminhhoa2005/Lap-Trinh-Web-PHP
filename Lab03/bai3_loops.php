<?php
// Lấy tham số n từ URL để dùng cho câu B và C
$n = isset($_GET["n"]) ? (int)$_GET["n"] : 0;

echo "<h2>Bài 3: Vòng lặp (Loops)</h2>";

// ---------------------------------------------------------
// A) In bảng cửu chương 1..9 dạng bảng HTML (for lồng nhau)
// ---------------------------------------------------------
echo "<h3>A) Bảng cửu chương (1-9)</h3>";
echo "<table border='1' cellpadding='5' style='border-collapse: collapse; text-align: center;'>";
echo "<tr>";
for ($i = 1; $i <= 9; $i++) {
    echo "<td style='vertical-align: top;'>";
    for ($j = 1; $j <= 10; $j++) {
        echo "$i x $j = " . ($i * $j) . "<br>";
    }
    echo "</td>";
}
echo "</tr>";
echo "</table>";

echo "<hr>";

// ---------------------------------------------------------
// B) Tính tổng chữ số của n (dùng while)
// Ví dụ: n = 12345 => 1 + 2 + 3 + 4 + 5 = 15
// ---------------------------------------------------------
echo "<h3>B) Tính tổng chữ số của n</h3>";
if ($n > 0) {
    $tempN = $n;
    $sum = 0;
    while ($tempN > 0) {
        $digit = $tempN % 10; // Lấy chữ số cuối cùng
        $sum += $digit;       // Cộng vào tổng
        $tempN = (int)($tempN / 10); // Bỏ chữ số cuối
    }
    echo "Tổng các chữ số của $n là: <strong>$sum</strong>";
} else {
    echo "Vui lòng nhập n > 0 (Ví dụ: ?page=bai3&n=12345)";
}

echo "<hr>";

// ---------------------------------------------------------
// C) In số lẻ từ 1..N (dùng continue và break)
// Dừng sớm khi số vượt quá 15
// ---------------------------------------------------------
echo "<h3>C) In các số lẻ từ 1 đến $n (Giới hạn tối đa 15)</h3>";
if ($n > 0) {
    echo "Dãy số: ";
    for ($i = 1; $i <= $n; $i++) {
        // Dùng break để dừng sớm khi vượt quá 15
        if ($i > 15) {
            echo "... (Dừng lại vì số đã vượt quá 15)";
            break;
        }

        // Dùng continue để bỏ qua số chẵn
        if ($i % 2 == 0) {
            continue;
        }

        echo "$i ";
    }
} else {
    echo "Vui lòng nhập n > 0";
}
?>