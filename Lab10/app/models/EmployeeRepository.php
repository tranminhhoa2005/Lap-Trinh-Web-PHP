<?php
require_once __DIR__ . '/../core/Model.php';

class EmployeeRepository extends Model {

    // 1. Lấy danh sách (Search + Filter + Sort)
    public function getAll($keyword = '', $dept_id = null, $sortCol = 'created_at', $sortDir = 'DESC') {
        $sql = "SELECT e.*, d.name as dept_name 
                FROM employees e 
                JOIN departments d ON e.dept_id = d.id 
                WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND e.full_name LIKE :kw";
            $params['kw'] = "%$keyword%";
        }
        if (!empty($dept_id)) {
            $sql .= " AND e.dept_id = :dept_id";
            $params['dept_id'] = $dept_id;
        }

        // Whitelist Sort
        $allowedCols = ['salary', 'created_at', 'full_name'];
        $allowedDirs = ['ASC', 'DESC'];
        $sortCol = in_array($sortCol, $allowedCols) ? $sortCol : 'created_at';
        $sortDir = in_array(strtoupper($sortDir), $allowedDirs) ? strtoupper($sortDir) : 'DESC';

        $sql .= " ORDER BY e.$sortCol $sortDir";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // 2. Lấy 1 nhân viên theo ID
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM employees WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // 3. Thêm mới
    public function create($data) {
        $sql = "INSERT INTO employees (full_name, email, salary, dept_id) VALUES (:name, :email, :salary, :dept_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // 4. Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE employees SET full_name=:name, email=:email, salary=:salary, dept_id=:dept_id WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id; 
        return $stmt->execute($data);
    }

    // 5. Xóa
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM employees WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>