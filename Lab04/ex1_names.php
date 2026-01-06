<?php
$raw = $_GET['names'] ?? '';
$names = [];
$original = htmlspecialchars($raw);

if (!empty($raw)) {
    // Tách, trim và loại bỏ phần tử rỗng
    $parts = explode(",", $raw);
    $names = array_map('trim', $parts);
    $names = array_filter($names, fn($value) => $value !== '');
}

function h($s) { return htmlspecialchars($s); }
?>

<!DOCTYPE html>
<html>
<body>
    <p>Chuỗi gốc: <?= $original ?></p>
    <?php if (empty($names)): ?>
        <p>Chưa có dữ liệu hợp lệ.</p>
    <?php else: ?>
        <p>Số lượng tên hợp lệ: <?= count($names) ?></p>
        <ol>
            <?php foreach ($names as $name): ?>
                <li><?= h($name) ?></li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</body>
</html>