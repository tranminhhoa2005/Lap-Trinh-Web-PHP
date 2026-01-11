<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $borrowID = $_POST['borrowID'];
    $borrows = json_decode(file_get_contents('../data/borrows.json'), true);
    $books = json_decode(file_get_contents('../data/books.json'), true);
    
    $found = false;
    foreach ($borrows as &$br) {
        if ($br['id'] == $borrowID && $br['status'] == 'borrowing') {
            $br['status'] = 'returned';
            $br['return_date'] = date('Y-m-d');
            $found = true;
            
            foreach ($books as &$b) {
                if ($b['id'] == $br['bookID']) {
                    $b['qty']++;
                    break;
                }
            }
            break;
        }
    }

    if ($found) {
        file_put_contents('../data/borrows.json', json_encode($borrows, JSON_PRETTY_PRINT));
        file_put_contents('../data/books.json', json_encode($books, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        $msg = "Trả sách thành công";
    } else {
        $msg = "Phiếu không tồn tại hoặc đã trả";
    }
}
?>
<form method="post">
    Mã phiếu mượn: <input type="text" name="borrowID" required><br>
    <button type="submit">Trả sách</button>
    <p><?= $msg ?></p>
</form>