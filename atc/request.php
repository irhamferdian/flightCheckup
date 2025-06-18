<?php
include 'auth.php';
include '../koneksi.php';

$username = $_SESSION['username'];
$atc_id = $_SESSION['atc_id'];

$sql = "SELECT fr.id AS request_id, fr.status, fr.request_time, fr.requested_runway_id,
               p.flight_number, fr.departure_place, fr.destination, fr.departure_date
        FROM flight_requests fr
        JOIN planes p ON fr.plane_id = p.id
        WHERE fr.status = 'Requested'
        ORDER BY fr.request_time DESC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Flight Requests</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    html, body { height: 100%; width: 100%; overflow: hidden; }
    body { display: flex; background-color: #f0f0f0; }
    .sidebar {
      width: 220px; background-color: #003366; padding: 20px; display: flex;
      flex-direction: column; color: #fff; position: fixed; top: 0; left: 0; height: 100%;
    }
    .sidebar h2 { text-align: center; margin-bottom: 30px; }
    .sidebar a {
      color: #fff; text-decoration: none; display: flex; align-items: center;
      gap: 10px; padding: 10px; border-radius: 8px; margin-bottom: 15px;
      transition: background-color 0.3s; font-size: 14px;
    }
    .sidebar a:hover, .sidebar a.active { background-color: #001f4d; }
    .main {
      margin-left: 220px; flex: 1; background-color: white;
      padding: 30px; overflow-y: auto; height: 100vh;
    }
    .search-bar {
      width: 100%; margin-bottom: 20px; display: flex; justify-content: flex-end;
    }
    .search-bar input {
      padding: 8px 15px; border-radius: 20px; border: 1px solid #ccc; width: 250px;
    }
    .flight-card {
      background-color: #fff; border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px;
    }
    .flight-header {
      display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;
    }
    .flight-header img { height: 30px; }
    .flight-info {
      display: flex; justify-content: space-between;
      align-items: center; border-top: 1px solid #eee; padding-top: 10px; margin-top: 10px;
    }
    .flight-info div { text-align: center; }
    .status-buttons {
      display: flex; gap: 10px; margin-top: 10px;
    }
    .status-buttons button {
      padding: 5px 10px; border: none; border-radius: 5px;
      color: #fff; cursor: pointer; font-size: 12px;
    }
    .accept { background-color: #28a745; }
    .reject { background-color: #dc3545; }
    .flight-time { font-size: 12px; color: #666; }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>✈ Airlines</h2>
    <a href="dashboard.php"><i class="fa fa-chart-line"></i> Dashboard</a>
    <a href="flight.php"><i class="fa fa-plane"></i> Flights Details</a>
    <a href="map.php"><i class="fa fa-map"></i> Map</a>
    <a href="request.php" class="active"><i class="fa fa-paper-plane"></i> Request</a>
    <div style="flex:1"></div>
    <a href="support.php"><i class="fa fa-headset"></i> Support</a>
    <a href="atcprofile.php"><i class="fa fa-cog"></i> Settings</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="main">
    <div class="search-bar">
      <input type="text" placeholder="🔍 Flight number">
    </div>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="flight-card">
      <div class="flight-header">
        <span><i class="fa fa-plane"></i> <?= htmlspecialchars($row['flight_number']) ?></span>
        <img src="placeholder1.jpg" alt="Airline Logo">
      </div>
      <div class="flight-info">
        <div>
          <div><?= date('D, d M Y', strtotime($row['departure_date'])) ?></div>
          <div><?= htmlspecialchars($row['departure_place']) ?></div>
        </div>
        <div>→</div>
        <div>
          <div><?= htmlspecialchars($row['destination']) ?></div>
        </div>
        <div>
          <div>Request Runway <?= htmlspecialchars($row['requested_runway_id']) ?></div>
          <form method="post" action="handle_request.php" class="status-buttons">
            <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
            <button class="accept" type="submit" name="status" value="Accepted">Accept</button>
            <button class="reject" type="submit" name="status" value="Rejected">Reject</button>
          </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
