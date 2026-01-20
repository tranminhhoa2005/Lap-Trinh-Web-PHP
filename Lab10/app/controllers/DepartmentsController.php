<?php
require_once __DIR__ . '/../core/Controller.php';

class DepartmentsController extends Controller {
    private $deptRepo;

    public function __construct() {
        $this->deptRepo = $this->model('DepartmentRepository');
    }

    public function index() {
        $departments = $this->deptRepo->getAll();
        // Nhận thông báo lỗi nếu có
        $error = $_GET['error'] ?? null;
        $this->view('departments/index', ['departments' => $departments, 'error' => $error]);
    }

    public function create() {
        $this->view('departments/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->deptRepo->create($name);
                $this->redirect('index.php?c=departments');
            }
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $department = $this->deptRepo->findById($id);
        if ($department) {
            $this->view('departments/edit', ['department' => $department]);
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->deptRepo->update($id, $name);
                $this->redirect('index.php?c=departments');
            }
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            // Gọi hàm delete, nếu trả về false nghĩa là dính ràng buộc
            $result = $this->deptRepo->delete($id);
            
            if ($result) {
                $this->redirect('index.php?c=departments');
            } else {
                // Chuyển hướng kèm thông báo lỗi
                $msg = urlencode("Không thể xóa phòng ban này vì vẫn còn nhân viên!");
                $this->redirect("index.php?c=departments&error=$msg");
            }
        }
    }
}
?>