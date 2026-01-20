<?php
class Database {
    private $host = "localhost";
    private $db_name = "lab10_hr"; 
    private $username = "lab_user";    // User bạn vừa tạo lại
    private $password = "2808";        // Mật khẩu bạn vừa set
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            die("Lỗi kết nối: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
?>