<?php
if (isset($_GET['name']) && isset($_GET['age'])) {
    $name = htmlspecialchars($_GET['name']);
    $age = htmlspecialchars($_GET['age']);

    echo "<h2>Kết quả GET:</h2>";
    echo "Xin chào <strong>$name</strong>, tuổi: <strong>$age</strong>";
} else {
    echo "<h2>Vui lòng cung cấp tham số trên URL</h2>";
    echo "Hướng dẫn mẫu: <code>get_demo.php?name=An&age=20</code>";
}
?>