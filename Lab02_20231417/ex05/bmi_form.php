<!DOCTYPE html>
<html>
<head><title>Tính BMI</title></head>
<body>
    <form method="GET">
        Họ tên: <input type="text" name="name" required><br>
        Chiều cao (m): <input type="number" step="0.01" name="h" required><br>
        Cân nặng (kg): <input type="number" step="0.1" name="w" required><br>
        <button type="submit" name="calc">Tính BMI</button>
    </form>

    <?php
    if (isset($_GET['calc'])) {
        $name = $_GET['name'];
        $h = (float)$_GET['h'];
        $w = (float)$_GET['w'];

        if ($h > 0 && $w > 0) {
            $bmi = round($w / ($h * $h), 2);
            $loai = "";

            if ($bmi < 18.5) $loai = "Gầy";
            elseif ($bmi < 25) $loai = "Bình thường";
            elseif ($bmi < 30) $loai = "Thừa cân";
            else $loai = "Béo phì";

            echo "<h3>Kết quả:</h3>";
            echo "Chào $name, chỉ số BMI của bạn là: $bmi ($loai)";
        } else {
            echo "Vui lòng nhập số dương!";
        }
    }
    ?>
</body>
</html>