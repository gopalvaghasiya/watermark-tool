<?php
/**
 * Authentication Module for Watermark Studio
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Master Secret PIN / Password
define('APP_PASSWORD', '1243');

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION['watermark_logged_in'] = false;
    unset($_SESSION['watermark_logged_in']);
    session_destroy();
    header('Location: index.php');
    exit;
}

// Handle Login Submission
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['auth_password'])) {
    $entered_pass = trim($_POST['auth_password']);
    if ($entered_pass === APP_PASSWORD) {
        $_SESSION['watermark_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $login_error = 'Incorrect PIN. Please try again.';
    }
}

function is_authenticated() {
    return isset($_SESSION['watermark_logged_in']) && $_SESSION['watermark_logged_in'] === true;
}
