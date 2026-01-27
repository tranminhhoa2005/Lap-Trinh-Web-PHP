<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        .container { max-width: 1000px; margin: auto; }
        .header-actions { display: flex; justify-content: space-between; margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 8px 15px; cursor: pointer; border-radius: 4px; border: none; }
        .btn-add { background-color: #28a745; color: white; }
        .btn-edit { background-color: #ffc107; color: black; margin-right: 5px; }
        .btn-delete { background-color: #dc3545; color: white; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:hover { background-color: #f9f9f9; }

        /* Modal styling */
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: #fff; margin: 10% auto; padding: 20px; border-radius: 8px; width: 400px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .modal-footer { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Hệ thống Quản lý Sản phẩm</h2>
    <div class="header-actions">
        <input type="text" id="search-input" placeholder="Tìm kiếm theo tên hoặc mã sản phẩm...">
        <button class="btn-add" onclick="openModal('add')"> + Thêm sản phẩm</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            </tbody>
    </table>
</div>

<div id="productModal" class="modal">
    <div class="modal-content">
        <h3 id="modal-title">Thêm sản phẩm</h3>
        <form id="product-form">
            <input type="hidden" id="prod-id" name="id">
            <div class="form-group">
                <label>Mã sản phẩm:</label>
                <input type="text" id="prod-code" name="code" required>
            </div>
            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" id="prod-name" name="name" required>
            </div>
            <div class="form-group">
                <label>Giá (VNĐ):</label>
                <input type="number" id="prod-price" name="price" required>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()">Hủy</button>
                <button type="submit" class="btn-add" style="background-color: #007bff;">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>



<script>
$(document).ready(function() {
    // 1. Tải danh sách sản phẩm ban đầu
    loadProducts();

    // 2. Live Search: Gõ phím tới đâu lọc tới đó
    $('#search-input').on('keyup', function() {
        const query = $(this).val();
        loadProducts(query);
    });

    // 3. Xử lý Thêm/Sửa bằng Ajax
    $('#product-form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '../api/save.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    closeModal();
                    loadProducts(); // Cập nhật lại danh sách mà không reload trang
                } else {
                    alert("Lỗi: " + response.message);
                }
            },
            error: function() {
                alert("Không thể kết nối với máy chủ.");
            }
        });
    });
});

// Hàm tải dữ liệu qua Ajax (Search)
function loadProducts(query = '') {
    $.ajax({
        url: '../api/search.php',
        type: 'GET',
        data: { q: query },
        success: function(response) {
            if (response.success) {
                let rows = '';
                if (response.data.length === 0) {
                    rows = '<tr><td colspan="6" style="text-align:center;">Không tìm thấy sản phẩm nào.</td></tr>';
                } else {
                    response.data.forEach(p => {
                        rows += `
                            <tr id="row-${p.id}">
                                <td>${p.id}</td>
                                <td><b>${p.code}</b></td>
                                <td>${p.name}</td>
                                <td>${new Intl.NumberFormat('vi-VN').format(p.price)} đ</td>
                                <td>${p.created_at || 'N/A'}</td>
                                <td>
                                    <button class="btn-edit" onclick='openEditModal(${JSON.stringify(p)})'>Sửa</button>
                                    <button class="btn-delete" onclick="deleteProduct(${p.id})">Xóa</button>
                                </td>
                            </tr>`;
                    });
                }
                $('#product-table-body').html(rows);
            }
        }
    });
}

// Hàm xóa sản phẩm bằng Ajax
function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        $.ajax({
            url: '../api/delete.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    // Hiệu ứng xóa dòng mà không cần load lại toàn bộ danh sách
                    $(`#row-${id}`).fadeOut(400, function() {
                        $(this).remove();
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    }
}

// Điều khiển Modal
function openModal(type) {
    $('#product-form')[0].reset();
    $('#prod-id').val('');
    $('#modal-title').text(type === 'add' ? 'Thêm sản phẩm mới' : 'Sửa sản phẩm');
    $('#productModal').fadeIn();
}

function openEditModal(product) {
    openModal('edit');
    $('#prod-id').val(product.id);
    $('#prod-code').val(product.code);
    $('#prod-name').val(product.name);
    $('#prod-price').val(product.price);
}

function closeModal() {
    $('#productModal').fadeOut();
}
</script>

</body>
</html>