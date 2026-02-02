<?php 
include 'check_admin.php';
include '../config/db.php';

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if($id != $_SESSION['user_id']) $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: manage_users.php");
}

$users = $conn->query("SELECT * FROM users ORDER BY role DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thành viên của MyShop 👥</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #fff5f7; font-family: 'Quicksand', sans-serif; }
        .user-card { background: white; border-radius: 25px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; }
        .role-admin { background: #ff85a2; color: white; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; }
        .role-user { background: #fbe4e9; color: #ef476f; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #ef476f; font-weight: 700;">Gia đình MyShop 🍓</h2>
            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">🏠 Dashboard</a>
        </div>
        <div class="user-card card">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #fbe4e9; color: #ef476f;">
                    <tr>
                        <th class="ps-4">Thành viên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($u = $users->fetch_assoc()): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">@<?php echo $u['username']; ?></div>
                            <small class="text-muted">ID: <?php echo $u['id']; ?></small>
                        </td>
                        <td><?php echo $u['email']; ?></td>
                        <td>
                            <?php echo ($u['role'] == 1) ? '<span class="role-admin">Quản trị viên</span>' : '<span class="role-user">Khách hàng</span>'; ?>
                        </td>
                        <td class="text-center">
                            <?php if($u['id'] != $_SESSION['user_id']): ?>
                                <a href="?delete=<?php echo $u['id']; ?>" class="btn btn-sm text-danger fw-bold" onclick="return confirm('Xóa thành viên này nhé?')">Xóa bỏ 🧹</a>
                            <?php else: ?>
                                <span class="badge bg-light text-muted">Là bạn</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>