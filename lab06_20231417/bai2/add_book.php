<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = (int)$_POST['year'];
    $category = $_POST['category'];
    $qty = (int)$_POST['qty'];

    if ($year < 1900 || $year > date('Y')) $msg = "Năm không hợp lệ";
    elseif ($qty < 0) $msg = "Số lượng không hợp lệ";
    else {
        $file = '../data/books.json';
        $books = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        
        $exists = false;
        foreach ($books as $b) {
            if ($b['id'] === $id) { $exists = true; break; }
        }

        if ($exists) {
            $msg = "Mã sách đã tồn tại";
        } else {
            $books[] = ['id'=>$id, 'title'=>$title, 'author'=>$author, 'year'=>$year, 'category'=>$category, 'qty'=>$qty];
            file_put_contents($file, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $msg = "Thêm thành công";
        }
    }
}
?>
<form method="post">
    Mã sách: <input type="text" name="id" required><br>
    Tên sách: <input type="text" name="title" required><br>
    Tác giả: <input type="text" name="author" required><br>
    Năm XB: <input type="number" name="year" required><br>
    Thể loại: 
    <select name="category">
        <option>Giáo trình</option><option>Kỹ năng</option><option>Văn học</option><option>Khoa học</option><option>Khác</option>
    </select><br>
    Số lượng: <input type="number" name="qty" required><br>
    <button type="submit">Lưu</button>
    <p><?= $msg ?></p>
</form>
<a href="list_books.php">Xem danh sách</a>