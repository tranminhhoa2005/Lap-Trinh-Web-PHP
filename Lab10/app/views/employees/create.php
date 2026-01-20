<!DOCTYPE html>
<html>
<head><title>Thêm Nhân viên</title></head>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Thêm Nhân viên mới</h2>
    <form action="index.php?c=employees&a=store" method="POST">
        Họ tên: <input type="text" name="full_name" required><br><br>
        Email: <input type="email" name="email"><br><br>
        Lương: <input type="number" name="salary" required><br><br>
        Phòng ban:
        <select name="dept_id" required>
            <?php foreach ($departments as $d): ?>
                <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>