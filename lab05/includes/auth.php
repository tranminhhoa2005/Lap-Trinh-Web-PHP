<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

function is_logged_in(): bool {
    return !empty($_SESSION['auth']);
}

function require_login(): void {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}

function write_log(string $username, string $action): void {
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    $log_file = $dir . '/log.txt';
    $time = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$time] $username: $action" . PHP_EOL, FILE_APPEND);
}