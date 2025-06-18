<?php
 include 'auth.php'; $username = $_SESSION['username']; 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flights Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    html, body {
      height: 100%;
      width: 100%;
      overflow: hidden;
    }
    body {
      display: flex;
      background-color: #f0f0f0;
    }
    .sidebar {
      width: 220px;
      background-color: #003366;
      padding: 20px;
      display: flex;
      flex-direction: column;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
    }
    .sidebar h2 {
  font-weight: 700; /* tebal */
  font-size: 20px;  /* perbesar sedikit */
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px; /* jarak antara ikon dan teks */

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
      margin-left: 220px; /* to match sidebar width */
      flex: 1;
      background-color: white;
      padding: 30px;
      overflow-y: auto;
      height: 100vh;
    }
    .search-bar {
      width: 100%;
      margin-bottom: 20px;
      display: flex;
      justify-content: flex-end;
    }
    .search-bar input {
      padding: 8px 15px;
      border-radius: 20px;
      border: 1px solid #ccc;
      width: 250px;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }
    h2 {
      font-size: 16px;
      color: #666;
      text-align: center;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }
    th {
      background-color: #f5f5f5;
    }
    td a {
      color: #007bff;
      text-decoration: none;
      font-size: 13px;
    }
    td a:hover {
      text-decoration: underline;
    }
    .see-more {
      text-align: center;
      margin-top: 20px;
      color: #007bff;
      cursor: pointer;
      font-size: 14px;
    }
  </style>
</head>
<body>
   <div class="sidebar">
    <h2>✈ Airlines</h2>
    <a href="dashboard.php" ><i class="fas fa-chart-line"></i> Dashboard</a>
    <a href="flight.php" class="active" ><i class="fas fa-plane"></i> Flights Details</a>
    <a href="map.php"><i class="fas fa-map"></i> Map</a>
    <a href="request.php"><i class="fas fa-paper-plane"></i> Request</a>
    <div style="flex:1"></div>
    <a href="support.php"><i class="fas fa-headset"></i> Support</a>
    <a href="atcprofile.php"><i class="fas fa-cog"></i> Settings</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>


  <div class="main">
    <div class="search-bar">
      <input type="text" placeholder="🔍 Flight number">
    </div>

    <h2>Parague Airport<br>17 May 2022</h2>
    <h1><strong>LKPR</strong> Airport’s flights</h1>

    <table>
      <thead>
        <tr>
          <th>TIME</th>
          <th>FLIGHT</th>
          <th>DESTINATION</th>
          <th>RUNWAY</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr><td>06:00</td><td>GA101</td><td>Halim (HLP)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>07:15</td><td>ID202</td><td>Riau (RIM)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>08:30</td><td>SL303</td><td>Aceh (BTJ)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>09:00</td><td>MH404</td><td>Solo (SOC)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>10:15</td><td>SQ505</td><td>Bali (DPS)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>11:00</td><td>GA606</td><td>Kupang (KOE)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>12:30</td><td>ID707</td><td>Penang Int'l (PEN)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>13:45</td><td>SL808</td><td>Alor (ARD)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>14:00</td><td>MH909</td><td>Jayapura (DJJ)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>15:30</td><td>GA1010</td><td>Palu (PLW)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>16:45</td><td>ID1111</td><td>Ambon (AMQ)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>17:00</td><td>SL1212</td><td>Medan (MES)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>18:15</td><td>GA1313</td><td>Timika (TIM)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
        <tr><td>19:00</td><td>ID1414</td><td>Halim (HLP)</td><td>19C</td><td><a href="#">Details →</a></td></tr>
        <tr><td>21:41</td><td>AU789</td><td>Madrid (MAD)</td><td>19D</td><td><a href="#">Details →</a></td></tr>
      </tbody>
    </table>

    <div class="see-more">See more ⏷</div>
  </div>
</body>
</html>
