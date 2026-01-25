<?php
require_once __DIR__ . '/../../core/Database.php';

class Employee {
    private $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function getAll($q = '') {
        $sql = "SELECT * FROM employees WHERE full_name LIKE :q OR phone LIKE :q ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':q' => "%$q%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data) {
        $sql = "INSERT INTO employees (full_name, phone, position, salary) VALUES (?, ?, ?, ?)";
        return $this->db->prepare($sql)->execute([$data['full_name'], $data['phone'], $data['position'], $data['salary']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE employees SET full_name=?, phone=?, position=?, salary=? WHERE id=?";
        return $this->db->prepare($sql)->execute([$data['full_name'], $data['phone'], $data['position'], $data['salary'], $id]);
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM employees WHERE id = ?")->execute([$id]);
    }
}