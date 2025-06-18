<?php
 include 'auth.php'; $username = $_SESSION['username']; 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Map - Airlines</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body, html {
      width: 100%;
      height: 100%;
    }
    body {
      display: flex;
      background-color: #f0f0f0;
      overflow: hidden;
    }
    .sidebar {
      width: 220px;
      background-color: #003366;
      padding: 20px;
      display: flex;
      flex-direction: column;
      color: #fff;
      position: fixed;
      height: 100%;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      transition: background-color 0.3s;
      font-size: 14px;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #001f4d;
    }
    .main {
      margin-left: 220px;
      flex: 1;
      display: flex;
      flex-direction: column;
      height: 100vh;
      background-color: white;
    }
    .search-bar {
      width: 100%;
      padding: 10px;
      background-color: #fff;
      display: flex;
      justify-content: flex-end;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .search-bar input {
      padding: 8px 15px;
      border-radius: 20px;
      border: 1px solid #ccc;
      width: 250px;
    }
    .content {
      display: flex;
      flex: 1;
      overflow: hidden;
    }
    .flight-list {
      width: 300px;
      background-color: #f9f9f9;
      overflow-y: auto;
      padding: 10px;
    }
    .flight-item {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
      padding: 10px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .flight-item img {
      width: 60px;
      height: 40px;
      object-fit: cover;
      border-radius: 5px;
      margin-right: 10px;
    }
    .flight-item .info {
      display: flex;
      flex-direction: column;
      font-size: 12px;
    }
    .map-container {
      flex: 1;
      position: relative;
    }
    .map-placeholder {
      width: 100%;
      height: 100%;
      background-color: #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>✈ Airlines</h2>
    <a href="dashboard.php"><i class="fa fa-chart-line"></i> Dashboard</a>
    <a href="flight.php"><i class="fa fa-plane"></i> Flights Details</a>
    <a href="map.php" class="active"><i class="fa fa-map"></i> Map</a>
    <a href="request.php"><i class="fa fa-paper-plane"></i> Request</a>
    <div style="flex:1"></div>
    <a href="support.php"><i class="fa fa-headset"></i> Support</a>
    <a href="atcprofile.php"><i class="fa fa-cog"></i> Settings</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="main">
    <div class="search-bar">
      <input type="text" placeholder="🔍 Flight number">
    </div>

    <div class="content">
      <div class="flight-list">
        <div class="flight-item">
          <img src="placeholder1.jpg" alt="Plane 1">
          <div class="info">
            <strong>AB1234</strong>
            <span>Airbus A350-900</span>
            <span>LKPR → MAD</span>
          </div>
        </div>
        <div class="flight-item">
          <img src="placeholder2.jpg" alt="Plane 2">
          <div class="info">
            <strong>AB1234</strong>
            <span>Airbus A350-900</span>
            <span>LKPR → MAD</span>
          </div>
        </div>
        <div class="flight-item">
          <img src="placeholder3.jpg" alt="Plane 3">
          <div class="info">
            <strong>AB1234</strong>
            <span>Airbus A350-900</span>
            <span>LKPR → MAD</span>
          </div>
        </div>
        <div class="flight-item">
          <img src="placeholder4.jpg" alt="Plane 4">
          <div class="info">
            <strong>AB1234</strong>
            <span>Airbus A350-900</span>
            <span>LKPR → MAD</span>
          </div>
        </div>
        <div class="flight-item">
          <img src="placeholder5.jpg" alt="Plane 5">
          <div class="info">
            <strong>AU789</strong>
            <span>Cessna 172 Skyhawk</span>
            <span>LKPR → MAD</span>
          </div>
        </div>
      </div>

      <div class="map-container">
        <div class="map-placeholder">MAP PLACEHOLDER</div>
      </div>
    </div>
  </div>
</body>
</html>