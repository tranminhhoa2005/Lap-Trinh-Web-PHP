<?php
require_once "Student.php";
$students = [
    new Student("SV01", "An", 3.5),
    new Student("SV02", "Binh", 2.2),
    new Student("SV03", "Chi", 2.8),
    new Student("SV04", "Dung", 3.9),
    new Student("SV05", "Hoa", 2.6),
];

$gpas = array_map(fn($s) => $s->getGpa(), $students);
$avgGpa = array_sum($gpas) / count($gpas);

$stats = ['Giỏi' => 0, 'Khá' => 0, 'Trung bình' => 0];
foreach ($students as $s) { $stats[$s->rank()]++; }
?>

<table border="1">
    <tr><th>STT</th><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
    <?php foreach ($students as $i => $s): ?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= htmlspecialchars($s->getId()) ?></td>
        <td><?= htmlspecialchars($s->getName()) ?></td>
        <td><?= $s->getGpa() ?></td>
        <td><?= $s->rank() ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p>GPA trung bình lớp: <?= number_format($avgGpa, 2) ?></p>
<p>Thống kê: Giỏi: <?= $stats['Giỏi'] ?>, Khá: <?= $stats['Khá'] ?>, Trung bình: <?= $stats['Trung bình'] ?></p>