<?php
$fullName = "Trần Minh Hòa";
$age = 20;
$gpa = 2.58;
$isActive = true;

// Khai báo hằng
define("SCHOOL", "Đại học Công nghệ Đông Á");

// In dạng câu (echo)
echo "Sinh viên: $fullName, Tuổi: $age, GPA: $gpa, Trường: " . SCHOOL . "<br>";

// In dạng debug (var_dump)
echo "<pre>";
var_dump($fullName);
var_dump($age);
var_dump($gpa);
var_dump($isActive);
echo "</pre>";

// Nội suy chuỗi
echo "Dùng nháy kép: Tuoi: $age <br>"; // Kết quả: Tuoi: 20 (Biến được thực thi)
echo 'Dùng nháy đơn: Tuoi: $age <br>'; // Kết quả: Tuoi: $age (Biến được hiểu là text)
/* Nhận xét: 
- Nháy kép (") hỗ trợ nội suy biến trực tiếp vào chuỗi.
- Nháy đơn (') coi mọi thứ bên trong là chuỗi thuần túy, chạy nhanh hơn một chút.
*/
?>