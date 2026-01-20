<!DOCTYPE html>
<html>
<head><title>Sửa Nhân viên</title></head>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Cập nhật Nhân viên</h2>
    <form action="index.php?c=employees&a=update" method="POST">
        <input type="hidden" name="id" value="<?= $employee['id'] ?>">
        
        Họ tên: <input type="text" name="full_name" value="<?= htmlspecialchars($employee['full_name']) ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($employee['email']) ?>"><br><br>
        Lương: <input type="number" name="salary" value="<?= $employee['salary'] ?>" required><br><br>
        
        Phòng ban:
        <select name="dept_id" required>
            <?php foreach ($departments as $d): ?>
                <option value="<?= $d['id'] ?>" <?= $d['id'] == $employee['dept_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>