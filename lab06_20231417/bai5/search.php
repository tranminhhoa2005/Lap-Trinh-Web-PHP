<?php
$books = json_decode(file_get_contents('../data/books.json'), true) ?? [];
$results = $books;

if (isset($_GET['kw'])) {
    $results = [];
    $kw = mb_strtolower(trim($_GET['kw']));
    $cat = $_GET['category'] ?? 'all';

    foreach ($books as $b) {
        $title = mb_strtolower($b['title']);
        $author = mb_strtolower($b['author']);
        
        $matchKw = ($kw === '') || (strpos($title, $kw) !== false) || (strpos($author, $kw) !== false);
        $matchCat = ($cat === 'all') || ($b['category'] === $cat);

        if ($matchKw && $matchCat) {
            $results[] = $b;
        }
    }
}
?>

<form method="get">
    Từ khóa: <input type="text" name="kw" value="<?= htmlspecialchars($_GET['kw'] ?? '') ?>">
    Thể loại: 
    <select name="category">
        <option value="all">Tất cả</option>
        <option value="Giáo trình">Giáo trình</option>
        <option value="Kỹ năng">Kỹ năng</option>
        <option value="Văn học">Văn học</option>
        <option value="Khoa học">Khoa học</option>
        <option value="Khác">Khác</option>
    </select>
    <button type="submit">Tìm</button>
</form>

<table border="1">
    <tr><th>Mã</th><th>Tên</th><th>Tác giả</th><th>Thể loại</th><th>SL</th></tr>
    <?php if (empty($results)): ?>
        <tr><td colspan="5">Không tìm thấy</td></tr>
    <?php else: ?>
        <?php foreach ($results as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['id']) ?></td>
            <td><?= htmlspecialchars($r['title']) ?></td>
            <td><?= htmlspecialchars($r['author']) ?></td>
            <td><?= htmlspecialchars($r['category']) ?></td>
            <td><?= htmlspecialchars($r['qty']) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>