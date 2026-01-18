<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quản lý sinh viên (MVC + Ajax)</h2>
        
        <button type="button" class="btn btn-primary mb-3" id="btnAdd">
            + Thêm sinh viên
        </button>
        
        <div id="alertMessage"></div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                </tbody>
        </table>
    </div>

    <div class="modal fade" id="studentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Thêm sinh viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="studentForm">
                        <input type="hidden" id="studentId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Mã SV <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="code" name="code">
                            <div class="invalid-feedback" id="error_code"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name">
                            <div class="invalid-feedback" id="error_full_name"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="invalid-feedback" id="error_email"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSave">Lưu dữ liệu</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
