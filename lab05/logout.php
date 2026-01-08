<?php
require_once 'includes/auth.php';
require_once 'includes/csrf.php';
require_once 'includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf'] ?? '')) {
    write_log($_SESSION['user']['username'], "LOGOUT");
    session_unset();
    session_destroy();
    setcookie('remember_username', '', time() - 3600, '/');
    session_start();
    set_flash('info', 'Bạn đã đăng xuất.');
    header('Location: login.php');
    exit;
}
die("Lỗi CSRF!");