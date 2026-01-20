<!DOCTYPE html>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Thêm Phòng Ban</h2>
    <form action="index.php?c=departments&a=store" method="POST">
        Tên phòng: <input type="text" name="name" required>
        <button type="submit">Lưu</button>
    </form>
</body>