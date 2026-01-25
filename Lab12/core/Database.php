<?php
class Database {
    private static $instance = null;
    public static function getConnection() {
        if (!self::$instance) {
            $config = require __DIR__ . '/../config/database.php';
            try {
                self::$instance = new PDO(
                    "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                    $config['user'], $config['pass']
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Lỗi kết nối CSDL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}