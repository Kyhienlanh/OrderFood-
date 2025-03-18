<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: /ProjectPHP/login.php");
    exit();
}

?>