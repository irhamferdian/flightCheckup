<?php
include 'auth.php';
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plane_id = intval($_POST['plane_id']);
    $pilot_id = $_SESSION['pilot_id'];

    // Ambil dan sanitasi input
    $tail_no = mysqli_real_escape_string($koneksi, $_POST['tail_no']);
    $flight_number = mysqli_real_escape_string($koneksi, $_POST['flight_number']);
    $call_sign = mysqli_real_escape_string($koneksi, $_POST['call_sign']);
    $age = intval($_POST['age']);
    $range_miles = intval($_POST['range_miles']);
    $first_flight = mysqli_real_escape_string($koneksi, $_POST['first_flight']); // format: YYYY-MM-DD

    // Validasi minimal
    if (empty($tail_no) || empty($flight_number) || empty($call_sign)) {
        echo "Semua field wajib diisi.";
        exit;
    }

    // Update data pesawat
    $update_query = "
        UPDATE planes 
        SET 
            tail_no = '$tail_no', 
            flight_number = '$flight_number', 
            call_sign = '$call_sign',
            age = $age,
            range_miles = $range_miles,
            first_flight = '$first_flight'
        WHERE id = '$plane_id' AND pilot_id = '$pilot_id'
    ";

    if (mysqli_query($koneksi, $update_query)) {
        header("Location: infoplane.php?success=1");
        exit;
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>
