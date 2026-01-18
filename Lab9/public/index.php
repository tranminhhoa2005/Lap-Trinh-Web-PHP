<?php
// Autoload manual
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/models/StudentModel.php';
require_once __DIR__ . '/../app/controllers/StudentController.php';

$controller = new StudentController();

// Lấy tham số route, mặc định là 'index'
$route = $_GET['route'] ?? 'index';

switch ($route) {
    case 'index':
        $controller->index();
        break;
    case 'api':
        $controller->api();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}