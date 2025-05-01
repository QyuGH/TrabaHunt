<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php"); // adjust the path if needed
    exit;
}
?>
