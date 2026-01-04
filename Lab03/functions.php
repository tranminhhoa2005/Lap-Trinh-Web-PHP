<?php
/**
 * functions.php
 * Thư viện các hàm toán học cơ bản cho Lab 03
 */

// 1. Tìm số lớn nhất giữa 2 số
function max2($a, $b) {
    return ($a >= $b) ? $a : $b;
}

// Tìm số nhỏ nhất giữa 2 số
function min2($a, $b) {
    return ($a <= $b) ? $a : $b;
}

/**
 * 2. Kiểm tra số nguyên tố
 * Trả về true nếu $n là số nguyên tố, ngược lại false
 */
function isPrime(int $n): bool {
    if ($n < 2) return false;
    // Kiểm tra từ 2 đến căn bậc hai của n để tối ưu hiệu năng
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

/**
 * 3. Tính giai thừa (n!)
 * Trả về giai thừa nếu n >= 0, trả về null nếu n < 0
 */
function factorial(int $n) {
    if ($n < 0) return null;
    if ($n == 0 || $n == 1) return 1;
    
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

/**
 * 4. Tìm ước chung lớn nhất (GCD)
 * Sử dụng thuật toán Euclid: gcd(a, b) = gcd(b, a % b)
 */
function gcd(int $a, int $b): int {
    $a = abs($a);
    $b = abs($b);
    while ($b != 0) {
        $remainder = $a % $b;
        $a = $b;
        $b = $remainder;
    }
    return $a;
}
?>