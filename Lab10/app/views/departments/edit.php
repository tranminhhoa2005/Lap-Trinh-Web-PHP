<!DOCTYPE html>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Sửa Phòng Ban</h2>
    <form action="index.php?c=departments&a=update" method="POST">
        <input type="hidden" name="id" value="<?= $department['id'] ?>">
        Tên phòng: <input type="text" name="name" value="<?= htmlspecialchars($department['name']) ?>" required>
        <button type="submit">Cập nhật</button>
    </form>
</body>