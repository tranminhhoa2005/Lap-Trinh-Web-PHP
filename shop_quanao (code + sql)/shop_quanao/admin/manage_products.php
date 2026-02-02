<?php 
include 'check_admin.php'; 
include '../config/db.php'; 

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM products WHERE id = $id");
    header("Location: manage_products.php?msg=deleted");
    exit();
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý kho hàng 🌸</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #fff5f7; font-family: 'Quicksand', sans-serif; }
        .main-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(255, 133, 162, 0.1);
            border: none;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%);
            color: white;
        }
        .table thead th { border: none; padding: 15px; }
        .img-thumb {
            width: 60px; height: 60px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid #fbe4e9;
        }
        .btn-edit {
            background-color: #ffcaaf;
            color: #d35400;
            border-radius: 10px;
            border: none;
            font-weight: 700;
        }
        .btn-delete {
            background-color: #fbc2eb;
            color: #833ab4;
            border-radius: 10px;
            border: none;
            font-weight: 700;
        }
        .badge-tag {
            background-color: #fbe4e9;
            color: #ef476f;
            border-radius: 8px;
            padding: 5px 10px;
        }
        .price-text { color: #ef476f; font-weight: 700; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #ef476f; font-weight: 700;">Danh sách sản phẩm ✨</h2>
            <div>
                <a href="add_product.php" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background: #ff85a2; border: none;">+ Thêm mới</a>
                <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Bảng điều khiển</a>
            </div>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-success border-0 rounded-4 shadow-sm">Đã dọn dẹp sản phẩm khỏi kho! 🧹</div>
        <?php endif; ?>

        <div class="main-card card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Tồn kho</th>
                            <th>Phân loại</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="../images/<?php echo $row['image']; ?>" class="img-thumb me-3">
                                    <div>
                                        <div class="fw-bold"><?php echo htmlspecialchars($row['name']); ?></div>
                                        <small class="text-muted">ID: #<?php echo $row['id']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="price-text"><?php echo number_format($row['price']); ?>đ</span></td>
                            <td class="fw-bold text-muted"><?php echo $row['stock_quantity']; ?> chiếc</td>
                            <td><span class="badge-tag small"><?php echo $row['tag']; ?></span></td>
                            <td class="text-center">
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-edit btn-sm px-3 me-2">Sửa</a>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-delete btn-sm px-3" onclick="return confirm('Xóa món này là không lấy lại được đâu nha?')">Xóa</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>