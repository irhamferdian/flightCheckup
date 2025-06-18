<?php
require_once 'auth.php';
require_once '../koneksi.php';

$username = $_SESSION['username'] ?? null;

if (!$username) {
    header("Location: loginatc.php");
    exit;
}

$stmt = $koneksi->prepare("SELECT name, shift, created_at FROM atc_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$atc = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ATC Profile</title>
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background: url('plane.png') no-repeat center center fixed;
      background-size: cover;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .back-button a {
      background-color: #004aad;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .profile-box {
      display: flex;
      background-color: rgba(255, 255, 255, 0.88);
      padding: 60px 80px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      align-items: center;
    }

    .profile-image {
      margin-right: 60px;
      flex-shrink: 0;
    }

    .profile-image img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid #004aad;
    }

    .profile-details h2 {
      margin: 0 0 20px;
      font-size: 32px;
      color: #003366;
    }

    .profile-details p {
      margin: 10px 0;
      font-size: 22px;
      color: #333;
    }
  </style>
</head>
<body>

  <div class="back-button">
    <a href="dashboard.php">&larr; Back</a>
  </div>

  <div class="container">
    <div class="profile-box">
      <div class="profile-image">
        <img src="profile.png" alt="Profile" />
      </div>
      <div class="profile-details">
        <h2>ATC Profile</h2>
        <p><strong><?= htmlspecialchars($atc['name']) ?></strong></p>
        <p>Shift: <?= htmlspecialchars($atc['shift']) ?></p>
        <p>Joined: <?= date("d M Y", strtotime($atc['created_at'])) ?></p>
      </div>
    </div>
  </div>

</body>
</html>
