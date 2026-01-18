<?php
class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    // Render giao diện chính
    public function index() {
        require_once __DIR__ . '/../views/students/index.php';
    }

    // Xử lý API Ajax
    public function api() {
        header('Content-Type: application/json');
        $action = $_GET['action'] ?? '';
        
        try {
            switch ($action) {
                case 'list':
                    $data = $this->model->getAll();
                    echo json_encode(['success' => true, 'data' => $data]);
                    break;

                case 'create':
                case 'update':
                    $this->handleSave($action);
                    break;

                case 'delete':
                    $this->handleDelete();
                    break;
                
                case 'get_one': // Lấy 1 sv để sửa
                    $id = $_GET['id'] ?? 0;
                    $data = $this->model->getById($id);
                    if($data) echo json_encode(['success' => true, 'data' => $data]);
                    else echo json_encode(['success' => false, 'message' => 'Not found']);
                    break;

                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid action']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    private function handleSave($action) {
        $id = $_POST['id'] ?? null;
        $code = trim($_POST['code'] ?? '');
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $dob = $_POST['dob'] ?? '';

        // Validate
        $errors = [];
        if (empty($code)) $errors['code'] = 'Mã SV không được để trống';
        if (empty($full_name)) $errors['full_name'] = 'Họ tên không được để trống';
        if (empty($email)) $errors['email'] = 'Email không được để trống';
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email không đúng định dạng';

        // Check trùng Code/Email
        if (empty($errors)) {
            $isDuplicate = $this->model->checkExists($code, $email, ($action == 'update' ? $id : null));
            if ($isDuplicate) {
                echo json_encode(['success' => false, 'message' => 'Mã SV hoặc Email đã tồn tại trong hệ thống']);
                return;
            }
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        $data = ['code' => $code, 'full_name' => $full_name, 'email' => $email, 'dob' => $dob];

        if ($action == 'create') {
            $this->model->create($data);
            echo json_encode(['success' => true, 'message' => 'Thêm mới thành công']);
        } else {
            $this->model->update($id, $data);
            echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
        }
    }

    private function handleDelete() {
        $id = $_POST['id'] ?? 0;
        if ($this->model->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'Xóa thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Xóa thất bại']);
        }
    }
}