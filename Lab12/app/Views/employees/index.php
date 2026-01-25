<h2>Danh sách nhân viên</h2>
<form method="GET">
    <input type="hidden" name="c" value="employee">
    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Tìm tên hoặc SĐT...">
    <button type="submit">Tìm</button>
</form>
<a href="index.php?c=employee&a=create">Thêm mới</a>
<table border="1" width="100%">
    <tr>
        <th>ID</th><th>Họ tên</th><th>SĐT</th><th>Vị trí</th><th>Lương</th><th>Hành động</th>
    </tr>
    <?php foreach ($employees as $emp): ?>
    <tr>
        <td><?= $emp['id'] ?></td>
        <td><?= htmlspecialchars($emp['full_name']) ?></td>
        <td><?= htmlspecialchars($emp['phone']) ?></td>
        <td><?= htmlspecialchars($emp['position']) ?></td>
        <td><?= number_format($emp['salary']) ?></td>
        <td>
            <a href="index.php?c=employee&a=edit&id=<?= $emp['id'] ?>">Sửa</a> |
            <a href="index.php?c=employee&a=delete&id=<?= $emp['id'] ?>" onclick="return confirm('Xóa thật không?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>