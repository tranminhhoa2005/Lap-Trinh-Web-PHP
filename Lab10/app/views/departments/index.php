<!DOCTYPE html>
<html>
<head><title>DS Phòng ban</title></head>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Quản lý Phòng ban</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <a href="index.php?c=departments&a=create">Thêm phòng ban mới</a>
    <br><br>

    <table border="1" cellspacing="0" cellpadding="5" width="50%">
        <tr>
            <th>ID</th>
            <th>Tên phòng</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($departments as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td>
                <a href="index.php?c=departments&a=edit&id=<?= $d['id'] ?>">Sửa</a> |
                <form action="index.php?c=departments&a=delete" method="POST" style="display:inline;" onsubmit="return confirm('Xóa phòng này?');">
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>