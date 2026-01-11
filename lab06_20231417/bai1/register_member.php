<?php
$name = $email = $phone = $dob = $gender = $address = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $dob = trim($_POST["dob"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $address = trim($_POST["address"] ?? "");

    if (empty($name)) $errors[] = "Thiếu họ tên";
    if (empty($email)) $errors[] = "Thiếu email";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email sai định dạng";
    
    if (empty($phone)) $errors[] = "Thiếu số điện thoại";
    elseif (!preg_match('/^[0-9]{9,11}$/', $phone)) $errors[] = "SĐT phải từ 9-11 số";

    if (empty($dob)) $errors[] = "Thiếu ngày sinh";
    if (empty($gender)) $errors[] = "Chưa chọn giới tính";

    if (empty($errors)) {
        $memberID = "TV" . time();
        $record = [$memberID, $name, $email, $phone, $dob, $gender, $address];
        $file = fopen('../data/members.csv', 'a');
        if ($file) {
            fputcsv($file, $record);
            fclose($file);
            include 'member_result.php';
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Đăng ký</title></head>
<body>
    <?php if (!empty($errors)): ?>
        <ul style="color:red">
            <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
        </ul>
    <?php endif; ?>
    <form method="POST">
        Họ tên: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>
        Email: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
        SĐT: <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>"><br>
        Ngày sinh: <input type="date" name="dob" value="<?= htmlspecialchars($dob) ?>"><br>
        Giới tính: 
        <input type="radio" name="gender" value="Nam" <?= $gender=="Nam"?"checked":"" ?>> Nam
        <input type="radio" name="gender" value="Nữ" <?= $gender=="Nữ"?"checked":"" ?>> Nữ
        <input type="radio" name="gender" value="Khác" <?= $gender=="Khác"?"checked":"" ?>> Khác<br>
        Địa chỉ: <textarea name="address"><?= htmlspecialchars($address) ?></textarea><br>
        <button type="submit">Đăng ký</button>
        <button type="button" onclick="window.location.href='register_member.php'">Reset</button>
    </form>
</body>
</html>