<?php
include 'auth.php';
include '../koneksi.php';

$pilot_id = $_SESSION['pilot_id'];
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];
$runway_id = $_POST['runway'];

// Cek pesawat pilot
$plane_query = mysqli_query($koneksi, "SELECT id FROM planes WHERE pilot_id = '$pilot_id' LIMIT 1");
$plane = mysqli_fetch_assoc($plane_query);

if (!$plane) {
    die("Pesawat tidak ditemukan.");
}
$plane_id = $plane['id'];

// Simpan langsung data ke flight_requests
$sql = "INSERT INTO flight_requests (
            plane_id, requested_runway_id, request_time, status,
            departure_place, destination, departure_date
        ) VALUES (
            '$plane_id', '$runway_id', NOW(), 'Requested',
            '$from', '$to', '$date'
        )";

mysqli_query($koneksi, $sql);

// Redirect ke halaman takeoff
header("Location: takeoff.php");
exit;
?>
