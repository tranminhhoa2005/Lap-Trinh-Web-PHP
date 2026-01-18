<?php
require_once __DIR__ . '/../config/db.php';

class Database {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                self::$conn = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (PDOException $e) {
                die("Lỗi kết nối CSDL: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}