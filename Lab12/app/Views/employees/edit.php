<h2>Sửa thông tin nhân viên</h2>

<?php if (!$employee): ?>
    <p>Không tìm thấy nhân viên!</p>
<?php else: ?>
    
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <p>Họ tên: <br>
            <input type="text" name="full_name" value="<?= htmlspecialchars($employee['full_name']) ?>" required>
        </p>
        <p>Số điện thoại: <br>
            <input type="text" name="phone" value="<?= htmlspecialchars($employee['phone']) ?>" required>
        </p>
        <p>Vị trí: <br>
            <input type="text" name="position" value="<?= htmlspecialchars($employee['position']) ?>" required>
        </p>
        <p>Lương: <br>
            <input type="number" name="salary" value="<?= htmlspecialchars($employee['salary']) ?>">
        </p>
        <button type="submit">Cập nhật</button>
        <a href="index.php?c=employee&a=index">Hủy bỏ</a>
    </form>
<?php endif; ?>