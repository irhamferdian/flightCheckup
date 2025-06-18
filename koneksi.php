<?php
$host     = "localhost"; // atau 127.0.0.1
$user     = "root";      // default user XAMPP
$password = "";          // default kosong (jika belum diatur)
$database = "penerbangan"; // ganti dengan nama database kamu

$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
