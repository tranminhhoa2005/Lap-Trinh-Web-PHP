<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memID = $_POST['memID'];
    $bookID = $_POST['bookID'];
    
    $members = [];
    if (file_exists('../data/members.csv')) {
        $members = array_map('str_getcsv', file('../data/members.csv'));
    }
    
    $memExists = false;
    foreach ($members as $m) { if (isset($m[0]) && $m[0] == $memID) $memExists = true; }

    $books = json_decode(file_get_contents('../data/books.json'), true);
    $bookIndex = -1;
    foreach ($books as $k => $b) {
        if ($b['id'] == $bookID) { $bookIndex = $k; break; }
    }

    if (!$memExists) $msg = "Mã thành viên không tồn tại";
    elseif ($bookIndex == -1) $msg = "Mã sách không tồn tại";
    elseif ($books[$bookIndex]['qty'] <= 0) $msg = "Hết sách";
    else {
        $books[$bookIndex]['qty']--; 
        file_put_contents('../data/books.json', json_encode($books, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

        $borrows = file_exists('../data/borrows.json') ? json_decode(file_get_contents('../data/borrows.json'), true) : [];
        $borrows[] = [
            'id' => uniqid(),
            'memID' => $memID,
            'bookID' => $bookID,
            'date' => date('Y-m-d'),
            'status' => 'borrowing'
        ];
        file_put_contents('../data/borrows.json', json_encode($borrows, JSON_PRETTY_PRINT));
        $msg = "Mượn thành công";
    }
}
?>
<form method="post">
    Mã TV: <input type="text" name="memID" required><br>
    Mã Sách: <input type="text" name="bookID" required><br>
    <button type="submit">Lập phiếu mượn</button>
    <p><?= $msg ?></p>
</form>