<?php
class StudentModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM students ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function checkExists($code, $email, $excludeId = null) {
        $sql = "SELECT count(*) as count FROM students WHERE (code = :code OR email = :email)";
        $params = ['code' => $code, 'email' => $email];
        
        if ($excludeId) {
            $sql .= " AND id != :id";
            $params['id'] = $excludeId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['count'] > 0;
    }

    public function create($data) {
        $sql = "INSERT INTO students (code, full_name, email, dob) VALUES (:code, :full_name, :email, :dob)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'code' => $data['code'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'dob' => $data['dob'] ?: null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE students SET code = :code, full_name = :full_name, email = :email, dob = :dob WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'code' => $data['code'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'dob' => $data['dob'] ?: null
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}