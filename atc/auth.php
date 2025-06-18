<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}
$username = $_SESSION['username'];
$atc_id = $_SESSION['atc_id'];
?>