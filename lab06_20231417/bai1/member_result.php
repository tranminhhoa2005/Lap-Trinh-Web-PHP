<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Kết quả</title></head>
<body>
    <h2>Đăng ký thành công</h2>
    <ul>
        <li>Mã TV: <?= htmlspecialchars($memberID) ?></li>
        <li>Họ tên: <?= htmlspecialchars($name) ?></li>
        <li>Email: <?= htmlspecialchars($email) ?></li>
        <li>SĐT: <?= htmlspecialchars($phone) ?></li>
        <li>Ngày sinh: <?= htmlspecialchars($dob) ?></li>
        <li>Giới tính: <?= htmlspecialchars($gender) ?></li>
        <li>Địa chỉ: <?= htmlspecialchars($address) ?></li>
    </ul>
    <a href="register_member.php">Quay lại</a>
</body>
</html>