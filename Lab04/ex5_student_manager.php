<?php
require_once "Student.php";
$list = [];
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['data'] ?? '';
    $threshold = (float)($_POST['threshold'] ?? 0);
    $doSort = isset($_POST['sort']);

    if (!empty($raw)) {
        $records = explode(";", trim($raw, ";"));
        foreach ($records as $rec) {
            $fields = explode("-", $rec);
            if (count($fields) === 3 && is_numeric($fields[2])) {
                $list[] = new Student($fields[0], $fields[1], $fields[2]);
            }
        }
    }

    if (empty($list)) {
        $error = "Chưa có dữ liệu hợp lệ.";
    } else {
        // Lọc theo ngưỡng GPA
        if ($threshold > 0) {
            $list = array_filter($list, fn($s) => $s->getGpa() >= $threshold);
        }
        // Sắp xếp
        if ($doSort) {
            usort($list, fn($a, $b) => $b->getGpa() <=> $a->getGpa());
        }
    }
}
?>

<form method="POST">
    <textarea name="data" rows="4" cols="50">SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5;SV004-Dung-3.8</textarea><br>
    Ngưỡng GPA >=: <input type="number" step="0.1" name="threshold"><br>
    Sắp xếp giảm dần: <input type="checkbox" name="sort"><br>
    <button type="submit">Parse & Show</button>
</form>

<?php if ($error): ?> <p style="color:red;"><?= $error ?></p> <?php endif; ?>

<?php if (!empty($list)): ?>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
        <?php foreach ($list as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s->getId()) ?></td>
            <td><?= htmlspecialchars($s->getName()) ?></td>
            <td><?= $s->getGpa() ?></td>
            <td><?= $s->rank() ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>