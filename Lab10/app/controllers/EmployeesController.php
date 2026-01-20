<?php
require_once __DIR__ . '/../core/Controller.php';

class EmployeesController extends Controller {
    private $empRepo;
    private $deptRepo;

    public function __construct() {
        $this->empRepo = $this->model('EmployeeRepository');
        $this->deptRepo = $this->model('DepartmentRepository');
    }

    public function index() {
        $keyword = $_GET['kw'] ?? '';
        $dept_id = $_GET['dept_id'] ?? '';
        $sortCol = $_GET['sort'] ?? 'created_at';
        $sortDir = $_GET['dir'] ?? 'DESC';

        $employees = $this->empRepo->getAll($keyword, $dept_id, $sortCol, $sortDir);
        $departments = $this->deptRepo->getAll();

        $this->view('employees/index', [
            'employees' => $employees,
            'departments' => $departments,
            'filters' => ['kw' => $keyword, 'dept_id' => $dept_id, 'sort' => $sortCol, 'dir' => $sortDir]
        ]);
    }

    public function create() {
        $departments = $this->deptRepo->getAll();
        $this->view('employees/create', ['departments' => $departments]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['full_name']);
            $salary = (float)$_POST['salary'];
            
            // Validate đơn giản
            if ($salary < 0 || empty($name)) {
                echo "<script>alert('Dữ liệu không hợp lệ!'); history.back();</script>";
                return;
            }

            $data = [
                'name' => $name,
                'email' => $_POST['email'],
                'salary' => $salary,
                'dept_id' => (int)$_POST['dept_id']
            ];

            $this->empRepo->create($data);
            $this->redirect('index.php?c=employees');
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $employee = $this->empRepo->findById($id);
        $departments = $this->deptRepo->getAll();

        if (!$employee) {
            die('Nhân viên không tồn tại');
        }

        $this->view('employees/edit', ['employee' => $employee, 'departments' => $departments]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $data = [
                'name' => trim($_POST['full_name']),
                'email' => $_POST['email'],
                'salary' => (float)$_POST['salary'],
                'dept_id' => (int)$_POST['dept_id']
            ];

            if ($data['salary'] >= 0) {
                $this->empRepo->update($id, $data);
                $this->redirect('index.php?c=employees');
            } else {
                echo "Lương không hợp lệ";
            }
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->empRepo->delete($id);
            $this->redirect('index.php?c=employees');
        }
    }
}
?>