<!DOCTYPE html>
<html>
<head><title>DS Nhân viên</title></head>
<body>
    <?php include __DIR__ . '/../menu.php'; ?>
    <h2>Danh sách Nhân viên</h2>
    
    <form action="index.php" method="GET" style="margin-bottom: 20px;">
        <input type="hidden" name="c" value="employees">
        <input type="text" name="kw" value="<?= htmlspecialchars($filters['kw']) ?>" placeholder="Tìm tên...">
        <select name="dept_id">
            <option value="">-- Tất cả phòng --</option>
            <?php foreach ($departments as $d): ?>
                <option value="<?= $d['id'] ?>" <?= $filters['dept_id'] == $d['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Lọc</button>
        <a href="index.php?c=employees&a=create">[Thêm mới]</a>
    </form>

    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Phòng</th>
            <th>Lương</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['id'] ?></td>
            <td><?= htmlspecialchars($emp['full_name']) ?></td>
            <td><?= htmlspecialchars($emp['dept_name']) ?></td>
            <td><?= number_format($emp['salary']) ?></td>
            <td>
                <a href="index.php?c=employees&a=edit&id=<?= $emp['id'] ?>">Sửa</a> |
                
                <form action="index.php?c=employees&a=delete" method="POST" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                    <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>