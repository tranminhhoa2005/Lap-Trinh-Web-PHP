<?php
// Lấy giá trị score từ URL, ép kiểu float để xử lý được số thập phân (VD: 7.5)
$score = isset($_GET["score"]) ? (float)$_GET["score"] : null;

if ($score === null) {
    echo "Hãy truyền tham số điểm số trên URL. Ví dụ: ?page=bai1&score=8.5";
    exit;
}

// 1. Kiểm tra tính hợp lệ (0 đến 10)
if ($score < 0 || $score > 10) {
    echo "Lỗi: Điểm số <strong>$score</strong> không hợp lệ! (Phải từ 0 đến 10)";
} 
else {
    // 2. Phân loại bằng if/elseif/else (Kiểm tra từ cao xuống thấp)
    if ($score >= 8.5) {
        $grade = "Giỏi";
    } elseif ($score >= 7.0) {
        $grade = "Khá";
    } elseif ($score >= 5.0) {
        $grade = "Trung bình";
    } else {
        $grade = "Yếu";
    }

    // 3. Hiển thị kết quả theo mẫu yêu cầu
    echo "Điểm: <strong>$score</strong> – Xếp loại: <strong>$grade</strong>";
}
?>
