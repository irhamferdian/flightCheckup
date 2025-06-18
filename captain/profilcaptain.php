<?php
include 'auth.php'; 
include '../koneksi.php';

// Ambil ID pilot dari session
$pilot_id = $_SESSION['pilot_id'];

// Ambil data pilot
$sql = "SELECT name, license_number, created_at FROM pilot_users WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $pilot_id);
$stmt->execute();
$result = $stmt->get_result();
$pilot = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Captain Profile</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #000;
      color: white;
      height: 100vh;
      overflow: hidden;
    }
    .blackscreen {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background-color: black;
      z-index: 0;
    }
    .background-container {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: url('kokpit.png') no-repeat center center;
      background-size: cover;
      opacity: 0.4;
      z-index: 1;
    }
    .container {
      position: relative;
      display: flex;
      height: 100vh;
      z-index: 2;
    }
    .left-panel {
      width: 35%;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 2rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      color: white;
    }
    .right-panel {
      flex: 1;
    }
    h1 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }
    p {
      margin: 0.5rem 0;
      font-size: 1rem;
    }
    .back-button {
      position: absolute;
      top: 1rem;
      left: 1rem;
      padding: 0.5rem 1rem;
      background-color: #ccc;
      border-radius: 6px;
      text-decoration: none;
      color: black;
      z-index: 3;
      font-weight: bold;
    }
    .back-button:hover {
      background-color: #999;
    }
  </style>
</head>
<body>
  <div class="blackscreen"></div>
  <div class="background-container"></div>

  <a href="dashboard.php" class="back-button">&larr; Back</a>

  <div class="container">
    <div class="left-panel">
      <h1>Captain Profile</h1>
      <p><strong>Name:</strong> <?= htmlspecialchars($pilot['name']) ?></p>
      <p><strong>License Number:</strong> <?= htmlspecialchars($pilot['license_number']) ?></p>
      <p><strong>Joined At:</strong> <?= date('F j, Y', strtotime($pilot['created_at'])) ?></p>
    </div>
    <div class="right-panel">
      <!-- Future content -->
    </div>
  </div>
</body>
</html>
