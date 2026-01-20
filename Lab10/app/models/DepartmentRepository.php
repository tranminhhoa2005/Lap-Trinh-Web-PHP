<?php
require_once __DIR__ . '/../core/Model.php';

class DepartmentRepository extends Model {
    
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM departments");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM departments WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($name) {
        $stmt = $this->conn->prepare("INSERT INTO departments (name) VALUES (:name)");
        return $stmt->execute(['name' => $name]);
    }

    public function update($id, $name) {
        $stmt = $this->conn->prepare("UPDATE departments SET name = :name WHERE id = :id");
        return $stmt->execute(['name' => $name, 'id' => $id]);
    }

    // Logic kiểm tra ràng buộc
    public function hasEmployees($deptId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM employees WHERE dept_id = :id");
        $stmt->execute(['id' => $deptId]);
        $row = $stmt->fetch();
        return $row['total'] > 0;
    }

    public function delete($id) {
        // Kiểm tra logic nghiệp vụ: Không xóa nếu còn nhân viên
        if ($this->hasEmployees($id)) {
            return false; // Trả về false để Controller biết mà báo lỗi
        }
        $stmt = $this->conn->prepare("DELETE FROM departments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>