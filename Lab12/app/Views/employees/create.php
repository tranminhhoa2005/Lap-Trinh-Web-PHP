<h2>Thêm nhân viên mới</h2>

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
    <p>Họ tên: <br><input type="text" name="full_name" required></p>
    <p>Số điện thoại: <br><input type="text" name="phone" required></p>
    <p>Vị trí: <br><input type="text" name="position" required></p>
    <p>Lương: <br><input type="number" name="salary" value="0"></p>
    <button type="submit">Lưu nhân viên</button>
    <a href="index.php?c=employee&a=index">Quay lại</a>
</form>