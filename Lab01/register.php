<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký thành viên</title>
</head>
<body>
    <h2>Form Đăng ký</h2>
    <form action="register.php" method="POST">
        Họ tên: <input type="text" name="fullname"><br><br>
        Email: <input type="email" name="email"><br><br>
        
        Giới tính: 
        <input type="radio" name="gender" value="Nam" checked> Nam
        <input type="radio" name="gender" value="Nữ"> Nữ <br><br>
        
        Sở thích:<br>
        <input type="checkbox" name="hobbies[]" value="Đọc sách"> Đọc sách<br>
        <input type="checkbox" name="hobbies[]" value="Đá bóng"> Đá bóng<br>
        <input type="checkbox" name="hobbies[]" value="Lập trình"> Lập trình<br><br>
        
        <button type="submit" name="btnRegister">Đăng ký</button>
    </form>

    <hr>

    <?php
    if (isset($_POST['btnRegister'])) {
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        
        if (empty($fullname) || empty($email)) {
            echo "<p style='color:red;'>Lỗi: Vui lòng nhập đầy đủ Họ tên và Email!</p>";
        } else {
            echo "<h3>Dữ liệu đã nhận:</h3>";
            echo "<ul>";
            echo "<li>Họ tên: " . htmlspecialchars($fullname) . "</li>";
            echo "<li>Email: " . htmlspecialchars($email) . "</li>";
            echo "<li>Giới tính: " . $_POST['gender'] . "</li>";
            
            if (isset($_POST['hobbies'])) {
                echo "<li>Sở thích: " . implode(", ", $_POST['hobbies']) . "</li>";
            } else {
                echo "<li>Sở thích: Không có</li>";
            }
            echo "</ul>";
        }
    }
    ?>
    
</body>
</html>