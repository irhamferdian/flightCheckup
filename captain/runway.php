<?php
include 'auth.php';
include '../koneksi.php';

$runway_query = mysqli_query($koneksi, "SELECT * FROM runways");
$runways = [];
while ($row = mysqli_fetch_assoc($runway_query)) {
  $runways[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Runway View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: #0e0e0e;
    }

    .sidebar {
      width: 70px;
      background-color: #ffffff;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      position: fixed;
      height: 100%;
    }

    .icon-group {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .icon-group i {
      font-size: 1.2rem;
      color: #1a1a1a;
      padding: 0.6rem;
      border-radius: 8px;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .icon-group i:hover,
    .icon-group i.active {
      background-color: #1e90ff;
      color: white;
    }

    .bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .profile {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #1e90ff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }

    .main-container {
      margin-left: 70px;
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      color: #1a1a1a;
    }

    .runway-list {
      background-color: white;
      border-radius: 16px;
      width: 250px;
      padding: 1rem;
      margin-right: 1rem;
      position: relative;
      z-index: 10;
    }

    .runway-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .runway-item img {
      width: 60px;
      height: 40px;
      object-fit: cover;
      border-radius: 8px;
    }

    .runway-item div {
      display: flex;
      flex-direction: column;
    }

    .map-container {
      flex: 1;
      background-color: #2d3e50;
      border-radius: 16px;
      overflow: hidden;
      position: relative;
    }

    .map-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      position: absolute;
      top: 0;
      left: 0;
    }

    .zoom-container {
      position: relative;
      overflow: hidden;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="icon-group">
      <a href="dashboard.php" class="nav-link active"><i class="fas fa-th-large"></i></a>
      <a href="infoplane.php" class="nav-link"><i class="fas fa-plane"></i></a>
      <a href="takeoff.php" class="nav-link"><i class="fas fa-road"></i></a>
      <a href="runway.php" class="nav-link"><i class="fas fa-map-marker-alt"></i></a>
    </div>
    <div class="bottom">
       <div class="profile-section">
  <a href="profilcaptain.php" style="display: block; width: 100%; height: 100%;">
    <div class="profile">
      <img src="profile.png" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; cursor: pointer;" />
    </div>
  </a>
</div>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>

  <div class="main-container">
    <button onclick="window.history.back()" style="margin-bottom:1rem; padding:0.5rem 1rem; border:none; background:#ccc; border-radius:8px; cursor:pointer;">&larr; Back</button>
    <div style="display:flex;">
      <div class="runway-list">
        <?php foreach ($runways as $runway): ?>
          <div class="runway-item">
            <img src="kokpit.png" alt="Runway <?= htmlspecialchars($runway['code']) ?>" />
            <div>
              <strong><?= htmlspecialchars($runway['code']) ?></strong>
              <span><?= htmlspecialchars($runway['status']) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="map-container zoom-container" id="zoom-container">
        <img src="kokpit.png" alt="Runway Map" id="zoom-image" />
      </div>
    </div>
  </div>

  <script>
    let scale = 1;
    const zoomContainer = document.getElementById('zoom-container');
    const zoomImage = document.getElementById('zoom-image');

    zoomContainer.addEventListener('wheel', (e) => {
      e.preventDefault();
      scale += e.deltaY * -0.001;
      scale = Math.min(Math.max(1, scale), 3);
      zoomImage.style.transform = `scale(${scale})`;
      zoomImage.style.transformOrigin = 'center center';
    });
  </script>
</body>
</html>
