<?php
// Tự động load các file core
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// Lấy Controller và Action từ URL
// Ví dụ: index.php?c=employees&a=index

// Mặc định vào trang Employees nếu không có tham số
$controllerName = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'EmployeesController';
$actionName = isset($_GET['a']) ? $_GET['a'] : 'index';

// Đường dẫn file controller
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Khởi tạo controller class
    $controller = new $controllerName();
    
    // Kiểm tra action có tồn tại trong class đó không
    if (method_exists($controller, $actionName)) {
        // Gọi action
        $controller->{$actionName}();
    } else {
        // Xử lý lỗi Action không tìm thấy
        echo "Lỗi 404 - Action '$actionName' không tồn tại trong $controllerName";
    }
} else {
    // Xử lý lỗi Controller không tìm thấy
    echo "Lỗi 404 - Controller '$controllerName' không tồn tại. Hãy kiểm tra URL.";
}
?>