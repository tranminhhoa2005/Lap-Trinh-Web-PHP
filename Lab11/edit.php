<?php
// --- NHÚNG KẾT NỐI CSDL TRỰC TIẾP ---
$host = 'localhost';
$dbname = 'lab11_categories'; 
$username = 'root';
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}
// ------------------------------------

session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$errors = [];

// Lấy dữ liệu cũ
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->execute(['id' => $id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die("Không tìm thấy danh mục (ID không tồn tại)!");
}

// Gán giá trị ban đầu
$name = $category['name'];
$slug = $category['slug'];
$description = $category['description'];
$status = $category['status'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $description = trim($_POST['description']);
    $status = (int)$_POST['status'];

    // Validate
    if (empty($name)) $errors['name'] = 'Tên là bắt buộc.';
    if (empty($slug)) {
        $errors['slug'] = 'Slug là bắt buộc.';
    } else {
        // Check unique: Slug trùng nhưng ID phải KHÁC ID hiện tại
        $stmtCheck = $conn->prepare("SELECT id FROM categories WHERE slug = :slug AND id != :id");
        $stmtCheck->execute(['slug' => $slug, 'id' => $id]);
        if ($stmtCheck->rowCount() > 0) {
            $errors['slug'] = 'Slug này đã thuộc về danh mục khác.';
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE categories SET name=:name, slug=:slug, description=:desc, status=:status, updated_at=NOW() WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name'=>$name, 'slug'=>$slug, 'desc'=>$description, 'status'=>$status, 'id'=>$id]);
        
        $_SESSION['success'] = "Cập nhật thành công!";
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Danh Mục</title>
    <style>.error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h2>Cập nhật Danh Mục</h2>
    <a href="index.php">Quay lại danh sách</a>
    <hr>
    
    <form action="" method="POST">
        <div>
            <label>Tên danh mục (*):</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
            <?php if (isset($errors['name'])): ?>
                <span class="error"><?= $errors['name'] ?></span>
            <?php endif; ?>
        </div>

        <div style="margin-top: 10px;">
            <label>Slug (*):</label><br>
            <input type="text" name="slug" value="<?= htmlspecialchars($slug) ?>">
            <?php if (isset($errors['slug'])): ?>
                <span class="error"><?= $errors['slug'] ?></span>
            <?php endif; ?>
        </div>

        <div style="margin-top: 10px;">
            <label>Mô tả:</label><br>
            <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
        </div>

        <div style="margin-top: 10px;">
            <label>Trạng thái:</label>
            <select name="status">
                <option value="1" <?= $status == 1 ? 'selected' : '' ?>>Hoạt động</option>
                <option value="0" <?= $status == 0 ? 'selected' : '' ?>>Tạm khóa</option>
            </select>
        </div>

        <br>
        <button type="submit">Cập nhật (Update)</button>
    </form>
</body>
</html>