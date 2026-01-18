$(document).ready(function() {
    // 1. Load danh sách khi trang web tải xong
    loadStudents();

    // Hàm gọi API lấy danh sách
    function loadStudents() {
        $.ajax({
            url: 'index.php?route=api&action=list',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let rows = '';
                    if (response.data.length === 0) {
                        rows = '<tr><td colspan="6" class="text-center">Chưa có dữ liệu</td></tr>';
                    } else {
                        $.each(response.data, function(index, sv) {
                            rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${sv.code}</td>
                                    <td>${sv.full_name}</td>
                                    <td>${sv.email}</td>
                                    <td>${sv.dob ? sv.dob : ''}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-edit" data-id="${sv.id}">Sửa</button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="${sv.id}">Xóa</button>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    $('#studentTableBody').html(rows);
                }
            }
        });
    }

    // 2. Mở Modal Thêm mới
    $('#btnAdd').click(function() {
        $('#studentForm')[0].reset();
        $('#studentId').val('');
        $('#modalTitle').text('Thêm mới sinh viên');
        $('.is-invalid').removeClass('is-invalid'); // Xóa lỗi cũ
        $('#studentModal').modal('show');
    });

    // 3. Xử lý Lưu (Create/Update)
    $('#btnSave').click(function() {
        let id = $('#studentId').val();
        let action = id ? 'update' : 'create';
        let formData = $('#studentForm').serialize(); // Lấy data form

        // Reset error UI
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        $.ajax({
            url: `index.php?route=api&action=${action}`,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    $('#studentModal').modal('hide');
                    showAlert('success', res.message);
                    loadStudents(); // Reload lại bảng
                } else {
                    if (res.errors) {
                        // Hiển thị lỗi validate input
                        $.each(res.errors, function(field, msg) {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#error_${field}`).text(msg);
                        });
                    } else {
                        // Lỗi chung (như trùng code/email)
                        alert(res.message);
                    }
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi gọi API');
            }
        });
    });

    // 4. Mở Modal Sửa (Event Delegation vì nút được sinh ra động)
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        
        $.ajax({
            url: 'index.php?route=api&action=get_one',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    let sv = res.data;
                    $('#studentId').val(sv.id);
                    $('#code').val(sv.code);
                    $('#full_name').val(sv.full_name);
                    $('#email').val(sv.email);
                    $('#dob').val(sv.dob);
                    
                    $('#modalTitle').text('Cập nhật sinh viên');
                    $('.is-invalid').removeClass('is-invalid');
                    $('#studentModal').modal('show');
                }
            }
        });
    });

    // 5. Xử lý Xóa
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        if (confirm('Bạn có chắc chắn muốn xóa sinh viên này?')) {
            $.ajax({
                url: 'index.php?route=api&action=delete',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        showAlert('success', res.message);
                        loadStudents();
                    } else {
                        alert(res.message);
                    }
                }
            });
        }
    });

    // Helper: Hiển thị thông báo bootstrap alert
    function showAlert(type, msg) {
        let html = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${msg}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#alertMessage').html(html);
        setTimeout(() => $('#alertMessage').html(''), 3000); // Tự ẩn sau 3s
    }
});