<?php
include 'auth.php';
include '../koneksi.php';

$request_id = $_POST['request_id'];
$status = $_POST['status']; // 'Accepted' atau 'Rejected'
$atc_id = $_SESSION['atc_id']; // pastikan atc_id disimpan saat login

// Update status permintaan
mysqli_query($koneksi, "
    UPDATE flight_requests
    SET status = '$status',
        response_time = NOW(),
        handled_by = '$atc_id'
    WHERE id = '$request_id'
");

header("Location: request.php"); // kembali ke halaman permintaan
exit;
?>
