<?php
class Controller {
    // Hàm gọi model
    public function model($model) {
        // Kiểm tra file tồn tại trước khi require
        if (file_exists(__DIR__ . '/../models/' . $model . '.php')) {
            require_once __DIR__ . '/../models/' . $model . '.php';
            return new $model();
        } else {
            die("Model $model không tồn tại.");
        }
    }

    // Hàm gọi view và truyền dữ liệu
    public function view($view, $data = []) {
        // extract giúp biến mảng ['name' => 'A'] thành biến $name = 'A'
        extract($data); 
        
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View '$view' không tồn tại.");
        }
    }
    
    // Hàm chuyển hướng
    public function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
?>