<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}
$username = $_SESSION['username'];
$pilot_id = $_SESSION['pilot_id'];
?>