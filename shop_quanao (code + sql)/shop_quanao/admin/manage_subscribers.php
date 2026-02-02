<?php 
include 'check_admin.php';
include '../config/db.php';

$create_table = "CREATE TABLE IF NOT EXISTS subscribers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($create_table);

$message = "";
$type = "";

if(isset($_POST['send_notification'])) {
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    
    if(empty($subject) || empty($content)) {
        $message = "Vui lòng nhập đủ tiêu đề và nội dung!";
        $type = "danger";
    } else {
        $subscribers = $conn->query("SELECT email FROM subscribers");
        $count = 0;
        
        while($sub = $subscribers->fetch_assoc()) {
            $email = $sub['email'];
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: hello@thefashion.vn" . "\r\n";
            
            $email_body = "<html><body>";
            $email_body .= "<div style='background: linear-gradient(135deg, #ff85a2 0%, #ffd166 100%); padding: 20px; text-align: center; color: white; border-radius: 10px;'>";
            $email_body .= "<h2 style='font-family: Pacifico, cursive;'>👕 THE FASHION</h2>";
            $email_body .= "</div>";
            $email_body .= "<div style='background: #fff9fa; padding: 30px; border-radius: 10px; margin-top: 20px;'>";
            $email_body .= "<h3 style='color: #ef476f;'>$subject</h3>";
            $email_body .= "<p style='color: #4a4a4a; line-height: 1.6;'>$content</p>";
            $email_body .= "<div style='text-align: center; margin-top: 20px;'>";
            $email_body .= "<a href='http://localhost/shop_quanao/index.php' style='background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 50px; font-weight: bold;'>Xem Ngay</a>";
            $email_body .= "</div>";
            $email_body .= "</div>";
            $email_body .= "<p style='color: #999; font-size: 0.9rem; margin-top: 30px; text-align: center;'>&copy; 2026 THE FASHION. Made with 💖 by Student Project</p>";
            $email_body .= "</body></html>";
            
            if(mail($email, $subject, $email_body, $headers)) {
                $count++;
            }
        }
        
        $message = "✅ Đã gửi thông báo thành công đến $count người dùng!";
        $type = "success";
    }
}

$subscribers_result = $conn->query("SELECT * FROM subscribers ORDER BY created_at DESC");
$total_subscribers = $subscribers_result->num_rows;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Subscribers 📧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #fff5f7; font-family: 'Quicksand', sans-serif; }
        .main-card { background: white; border-radius: 30px; box-shadow: 0 15px 35px rgba(255, 133, 162, 0.1); border: none; overflow: hidden; }
        .stats-card { background: linear-gradient(135deg, #ffafcc 0%, #ffc2eb 100%); border-radius: 20px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .form-control { border-radius: 15px; border: 2px solid #fbe4e9; }
        .form-control:focus { border-color: #ff85a2; box-shadow: 0 0 0 0.2rem rgba(255, 133, 162, 0.25); }
        .btn-send { background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%); border: none; border-radius: 15px; color: white; font-weight: 700; padding: 12px 30px; }
        .btn-send:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(239, 71, 111, 0.4); color: white; }
        .table thead { background: linear-gradient(135deg, #ff85a2 0%, #ef476f 100%); color: white; }
        .img-email { width: 50px; height: 50px; background: #fbe4e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #ef476f; font-weight: 700;">📧 Quản lý Subscribers</h2>
            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">🏠 Dashboard</a>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <h6 class="small fw-bold mb-2">TỔNG SỐ SUBSCRIBERS</h6>
                    <h2 class="fw-bold"><?php echo $total_subscribers; ?></h2>
                    <p class="small mb-0">Người đã đăng ký nhận tin</p>
                </div>
            </div>
        </div>

        <?php if($message): ?>
            <div class="alert alert-<?php echo $type; ?> rounded-4 border-0 shadow-sm mb-4"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="main-card card mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4" style="color: #ef476f;">✉️ Gửi Thông Báo/Khuyến Mãi</h5>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #ef476f;">Tiêu đề</label>
                        <input type="text" name="subject" class="form-control" placeholder="Ví dụ: 🎉 Sale Sốc 50% - Hôm Nay Thôi!" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #ef476f;">Nội dung</label>
                        <textarea name="content" class="form-control" rows="6" placeholder="Nhập nội dung thông báo/khuyến mãi..." required></textarea>
                    </div>
                    <button type="submit" name="send_notification" class="btn btn-send w-100">🚀 Gửi Ngay</button>
                </form>
            </div>
        </div>

        <div class="main-card card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4" style="color: #ef476f;">📋 Danh Sách Subscribers</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Email</th>
                                <th>Ngày Đăng Ký</th>
                                <th class="text-center">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($total_subscribers > 0): ?>
                                <?php $subscribers_result = $conn->query("SELECT * FROM subscribers ORDER BY created_at DESC"); ?>
                                <?php while($sub = $subscribers_result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="img-email">📧</div>
                                            <div class="ms-3">
                                                <div class="fw-bold"><?php echo $sub['email']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="small text-muted"><?php echo date('d/m/Y H:i', strtotime($sub['created_at'])); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success">Hoạt động</span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        Chưa có subscribers nào! 😢
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
