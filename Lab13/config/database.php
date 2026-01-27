<?php
class Database {
    private $host = "localhost";
    private $db_name = "inventory_db";
    private $username = "root";
    private $password = ""; // Mặc định XAMPP để trống
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Kết nối lỗi: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>