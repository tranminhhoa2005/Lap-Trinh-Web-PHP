<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Employee.php';

class EmployeeController extends Controller {
    private $model;
    public function __construct() { $this->model = new Employee(); }

    public function index() {
        $q = $_GET['q'] ?? '';
        $employees = $this->model->getAll($q);
        $this->view('employees/index', ['employees' => $employees, 'q' => $q]);
    }

    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validate($_POST);
            if (empty($errors)) {
                $this->model->save($_POST);
                header("Location: index.php?c=employee&a=index");
                exit;
            }
        }
        $this->view('employees/create', ['errors' => $errors]);
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $employee = $this->model->find($id);
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validate($_POST);
            if (empty($errors)) {
                $this->model->update($id, $_POST);
                header("Location: index.php?c=employee&a=index");
                exit;
            }
        }
        $this->view('employees/edit', ['employee' => $employee, 'errors' => $errors]);
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php?c=employee&a=index");
    }

    private function validate($data) {
        $err = [];
        if (empty($data['full_name'])) $err[] = "Họ tên không được để trống";
        if (!preg_match('/^[0-9]{10}$/', $data['phone'])) $err[] = "SĐT phải gồm 10 chữ số";
        return $err;
    }
}