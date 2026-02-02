<?php 
include 'check_admin.php';
include '../config/db.php';

$id = intval($_GET['id']);
$p = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

if(isset($_POST['update'])) {
    $name = $_POST['name']; $price = $_POST['price']; 
    $tag = $_POST['tag']; $stock = $_POST['stock']; $desc = $_POST['description'];
    
    if($_FILES['image']['name'] != "") {
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$img);
    } else { $img = $p['image']; }

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, image=?, tag=?, stock_quantity=?, description=? WHERE id=?");
    $stmt->bind_param("sdssisi", $name, $price, $img, $tag, $stock, $desc, $id);
    $stmt->execute();
    header("Location: manage_products.php?msg=updated");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa sản phẩm 🎨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #fff5f7; font-family: 'Quicksand', sans-serif; }
        .edit-card { background: white; border-radius: 30px; box-shadow: 0 15px 35px rgba(255, 133, 162, 0.1); padding: 40px; border: none; }
        .form-control { border-radius: 12px; border: 1px solid #fbe4e9; background: #fff9fa; }
        .btn-update { background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%); border: none; border-radius: 12px; color: white; font-weight: 700; padding: 12px; }
        .current-img { width: 100px; border-radius: 15px; border: 3px solid #fbe4e9; margin-bottom: 10px; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 edit-card">
                <h3 class="mb-4" style="color: #ef476f; font-weight: 700;">Chỉnh sửa thông tin ✨</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $p['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">Phân loại (Tag)</label>
                            <input type="text" name="tag" class="form-control" value="<?php echo $p['tag']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">Giá bán (đ)</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $p['price']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted">Số lượng kho</label>
                            <input type="number" name="stock" class="form-control" value="<?php echo $p['stock_quantity']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted d-block">Hình ảnh hiện tại</label>
                        <img src="../images/<?php echo $p['image']; ?>" class="current-img">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted">Mô tả sản phẩm</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo $p['description']; ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-update w-100 shadow-sm">Lưu thay đổi ngay 🌸</button>
                    <div class="text-center mt-3"><a href="manage_products.php" class="text-muted small">Hủy bỏ và quay lại</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>