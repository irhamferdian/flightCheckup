<?php
 include 'auth.php';

$username = $_SESSION['username']; // ambil nama pengguna dari session
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome on board!</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    .nav-link {
  text-decoration: none;
}

.nav-link i {
  font-size: 1.2rem;
  color: #1a1a1a;
  cursor: pointer;
  padding: 0.6rem;
  border-radius: 8px;
  transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover i,
.nav-link.active i {
  background-color: #1e90ff;
  color: white;
}

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
      color: white;
    }

    .sidebar {
      width: 70px;
      background-color: #ffffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 0;
    }

    .sidebar .icon-group {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .sidebar .icon-group i {
      font-size: 1.2rem;
      color: #1a1a1a;
      cursor: pointer;
      padding: 0.6rem;
      border-radius: 8px;
      transition: background-color 0.3s;
    }

    .sidebar .icon-group i:hover {
      background-color: #1e90ff;
      color: white;
    }

    .sidebar .profile {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #1e90ff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: bold;
      color: white;
    }

    .sidebar .bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .main-content {
      flex: 1;
      padding: 3rem;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .image-container {
      position: relative;
      width: 700px;
      height: 240px;
      margin-bottom: 2rem;
    }

    .image-shadow {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.05);
      border-radius: 20px;
      filter: blur(10px);
      z-index: 0;
      top: 10px;
      left: 10px;
    }

    .image-card {
      position: relative;
      width: 100%;
      height: 100%;
      background: url('image.png') center/cover no-repeat;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.5);
      z-index: 1;
    }

    .welcome-text {
      font-size: 2rem;
      font-weight: bold;
      margin: 1rem 0;
    }

    .button-row {
      display: flex;
      gap: 2rem;
    }

    .card-button {
      width: 220px;
      padding: 1.2rem 1rem;
      border-radius: 12px;
      background: linear-gradient(to right, #ffbe76, #ff7979);
      color: white;
      font-weight: bold;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .card-button:hover {
      transform: translateY(-5px);
    }

    .card-button .label {
      font-size: 0.75rem;
      opacity: 0.8;
      margin-bottom: 0.5rem;
    }

    .card-button .title {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .card-button .icon {
      align-self: flex-end;
      font-size: 1.1rem;
    }

    .card-button.blue {
      background: linear-gradient(to right, #4a69bd, #60a3bc);
    }
    
   .sidebar {
  width: 70px;
  background-color: #ffffff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
}

.icon-group {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.icon-group a i {
  font-size: 1.2rem;
  color: #1a1a1a;
  padding: 0.6rem;
  border-radius: 8px;
  transition: background-color 0.3s;
  cursor: pointer;
}

.icon-group a i:hover {
  background-color: #1e90ff;
  color: white;
}

.profile-section {
  margin-top: auto;
  margin-bottom: 1rem;
}

.profile {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: #1e90ff;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 0.9rem;
}

.logout-section {
  margin-bottom: 1rem;
}

.logout-section i {
  font-size: 1.5rem;
  color: #1a1a1a;
  padding: 0.6rem;
  border-radius: 8px;
  transition: background-color 0.3s;
  cursor: pointer;
}

.logout-section i:hover {
  background-color: #1e90ff;
  color: white;
}

.card-button {
  text-decoration: none;
  color: inherit;
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

  <div class="profile-section">
  <a href="profilcaptain.php" style="display: block; width: 100%; height: 100%;">
    <div class="profile">
      <img src="profile.png" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; cursor: pointer;" />
    </div>
  </a>
</div>


  <div class="logout-section">
     <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
  </div>
</div>



  <div class="main-content">
    <div class="image-container">
      <div class="image-shadow"></div>
      <div class="image-card"></div>
    </div>
    <div class="welcome-text">Welcome on board!</div>
    <div class="button-row">
  <a href="takeoff.php" class="card-button">
    <div class="label">BEFORE FLIGHT</div>
    <div class="title">Ready for<br />takeoff?</div>
    <div class="icon"><i class="fas fa-play-circle"></i></div>
  </a>
  
  <a href="runway.php" class="card-button blue">
    <div class="label">ONBOARDING</div>
    <div class="title">Runway<br />status</div>
    <div class="icon"><i class="fas fa-play-circle"></i></div>
  </a>
</div>
  </div>
</body>

</html>
