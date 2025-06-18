<?php
include 'auth.php';
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $flight_number = $_POST['flight_number'];
    $runway_input = $_POST['runway_id'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];

    // Ambil ID ATC dari session
    if (!isset($_SESSION['atc_id'])) {
        die("Session user ID tidak ditemukan. Harap login ulang.");
    }
    $atc_id = $_SESSION['atc_id'];

    // Cari plane_id berdasarkan flight_number
    $plane_query = $koneksi->prepare("SELECT id FROM planes WHERE flight_number = ?");
    $plane_query->bind_param("s", $flight_number);
    $plane_query->execute();
    $plane_result = $plane_query->get_result();

    if ($plane_result->num_rows === 0) {
        die("✈️ Flight number tidak ditemukan dalam tabel planes.");
    }
    $plane = $plane_result->fetch_assoc();
    $plane_id = $plane['id'];

    // Cari runway_id berdasarkan nama runway
    $runway_query = $koneksi->prepare("SELECT id FROM runways WHERE code = ?");
    $runway_query->bind_param("s", $runway_input);
    $runway_query->execute();
    $runway_result = $runway_query->get_result();

    if ($runway_result->num_rows === 0) {
        die("🛫 Runway tidak ditemukan dalam tabel runways.");
    }
    $runway = $runway_result->fetch_assoc();
    $runway_id = $runway['id'];

    // Masukkan data ke tabel flights
    $stmt = $koneksi->prepare("INSERT INTO flights (plane_id, runway_id, atc_id, departure_place, destination, departure, arrival) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissss", $plane_id, $runway_id, $atc_id, $from, $to, $departure, $arrival);

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        echo "❌ Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
} else {
    header("Location: dashboard.php");
    exit;
}
