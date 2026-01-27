<?php
class Product {
    private $conn;
    private $table = "products";

    public function __construct($db) { $this->conn = $db; }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE name LIKE ? OR code LIKE ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($code, $name, $price) {
        $query = "INSERT INTO $this->table (code, name, price) VALUES (?, ?, ?)";
        return $this->conn->prepare($query)->execute([$code, $name, $price]);
    }

    public function update($id, $code, $name, $price) {
        $query = "UPDATE $this->table SET code=?, name=?, price=? WHERE id=?";
        return $this->conn->prepare($query)->execute([$code, $name, $price, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        return $this->conn->prepare($query)->execute([$id]);
    }

    public function getOne($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>