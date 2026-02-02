<?php 
include 'check_admin.php';
include '../config/db.php';

if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $tag = $_POST['tag'];
    $stock = $_POST['stock'];
    $desc = $_POST['description'];
    
    $img = $_FILES['image']['name'];
    $target = "../images/" . basename($img);
    
    $sql = "INSERT INTO products (name, price, image, tag, stock_quantity, description) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssis", $name, $price, $img, $tag, $stock, $desc);
    
    if($stmt->execute() && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "✨ Tuyệt vời! Đã thêm sản phẩm mới thành công.";
        $type = "success";
    } else {
        $msg = "Oops! Có lỗi gì đó rồi, kiểm tra lại nhé.";
        $type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới 🌸</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #fff5f7;
            font-family: 'Quicksand', sans-serif;
        }
        .form-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(255, 133, 162, 0.15);
            padding: 40px;
            margin-top: 50px;
            border: 2px solid #fbe4e9;
        }
        .form-control {
            border-radius: 15px;
            border: 1px solid #fbe4e9;
            padding: 12px 20px;
            background-color: #fff9fa;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25 margin-left rgba(255, 133, 162, 0.25);
            border-color: #ff85a2;
        }
        .btn-add {
            background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%);
            border: none;
            border-radius: 15px;
            padding: 12px;
            font-weight: 700;
            color: white;
            transition: 0.3s;
        }
        .btn-add:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(239, 71, 111, 0.4);
            color: white;
        }
        .title-pink {
            color: #ef476f;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 form-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="title-pink m-0">Đăng sản phẩm mới ✨</h3>
                    <a href="index.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Quay lại</a>
                </div>

                <?php if(isset($msg)): ?>
                    <div class="alert alert-<?php echo $type; ?> rounded-4 border-0 shadow-sm"><?php echo $msg; ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="small fw-bold text-muted ms-2">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" placeholder="Ví dụ: Váy hoa nhí Pastel" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold text-muted ms-2">Tag</label>
                            <input type="text" name="tag" class="form-control" placeholder="Hot, Sale, New">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold text-muted ms-2">Giá bán (đ)</label>
                            <input type="number" name="price" class="form-control" placeholder="250000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold text-muted ms-2">Số lượng kho</label>
                            <input type="number" name="stock" class="form-control" placeholder="10" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold text-muted ms-2">Mô tả sản phẩm</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Viết gì đó thật thu hút khách hàng nhé..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-muted ms-2">Hình ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <button type="submit" name="add" class="btn btn-add w-100 fs-5">Lên kệ ngay thôi! 🚀</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>