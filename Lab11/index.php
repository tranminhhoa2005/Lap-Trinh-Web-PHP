<?php
// --- BẮT ĐẦU ĐOẠN CODE KẾT NỐI (Thay cho require_once) ---
$host = 'localhost';
$dbname = 'lab11_categories'; // KIỂM TRA LẠI TÊN DB CỦA BẠN
$username = 'root';
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
// --- KẾT THÚC ĐOẠN CODE KẾT NỐI ---

session_start();

// Xử lý tìm kiếm
$keyword = '';
$sql = "SELECT * FROM categories";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $keyword = trim($_GET['search']);
    $sql .= " WHERE name LIKE :keyword OR slug LIKE :keyword";
}
$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
if ($keyword) {
    $stmt->execute(['keyword' => "%$keyword%"]);
} else {
    $stmt->execute();
}
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Danh mục</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .alert { padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Danh Sách Danh Mục</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form action="" method="GET">
        <input type="text" name="search" placeholder="Tìm theo tên hoặc slug..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Tìm kiếm</button>
        <a href="index.php"><button type="button">Reset</button></a>
    </form>
    
    <br>
    <a href="create.php"><strong>+ Thêm mới</strong></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories) > 0): ?>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['name']) ?></td>
                    <td><?= htmlspecialchars($cat['slug']) ?></td>
                    <td><?= $cat['status'] == 1 ? 'Hoạt động' : 'Tạm khóa' ?></td>
                    <td>
                        <a href="edit.php?id=<?= $cat['id'] ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $cat['id'] ?>" onclick="return confirm('Xóa hả?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Không tìm thấy dữ liệu.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>