<?php
session_start();
session_unset();    // Hapus semua variabel session
session_destroy();  // Hapus session

// Redirect ke halaman login
header("Location: ../login/login.php");
exit;
?>
