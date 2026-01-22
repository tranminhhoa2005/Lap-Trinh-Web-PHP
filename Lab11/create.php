<?php
session_start();
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

$errors = [];
$name = $slug = $description = '';
$status = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu và trim khoảng trắng
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $description = trim($_POST['description']);
    $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

    // 1. Validate Name
    if (empty($name)) {
        $errors['name'] = 'Tên danh mục là bắt buộc.';
    } elseif (strlen($name) < 3 || strlen($name) > 100) {
        $errors['name'] = 'Tên phải từ 3 đến 100 ký tự.';
    }

    // 2. Validate Slug
    if (empty($slug)) {
        $errors['slug'] = 'Slug là bắt buộc.';
    } elseif (!preg_match('/^[a-z0-9-]+$/', $slug)) {
        $errors['slug'] = 'Slug chỉ chứa chữ thường, số và dấu gạch ngang.';
    } else {
        // Check Unique Slug
        $stmt = $conn->prepare("SELECT id FROM categories WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        if ($stmt->rowCount() > 0) {
            $errors['slug'] = 'Slug này đã tồn tại, vui lòng chọn slug khác.';
        }
    }

    // Nếu không có lỗi -> Insert
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO categories (name, slug, description, status, created_at) VALUES (:name, :slug, :desc, :status, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'slug' => $slug,
                'desc' => $description,
                'status' => $status
            ]);

            // Flash Message
            $_SESSION['success'] = "Thêm mới thành công!";
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $errors['db'] = "Lỗi lưu dữ liệu: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Danh Mục</title>
    <style>.error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h2>Thêm Danh Mục Mới</h2>
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
        <button type="submit">Lưu (Save)</button>
    </form>
</body>
</html>