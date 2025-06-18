<?php
include 'auth.php'; 
include '../koneksi.php';
$username = $_SESSION['username'];

// Fetch data for select options
$flight_numbers = mysqli_query($koneksi, "SELECT flight_number FROM planes");
$runways = mysqli_query($koneksi, "SELECT code FROM runways");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body { display: flex; min-height: 100vh; background-color: #f0f0f0; color: #333; }

    .sidebar {
      width: 220px;
      background-color: #003366;
      display: flex;
      flex-direction: column;
      padding: 1rem;
      color: #fff;
      position: fixed;
      height: 100%;
      top: 0;
      left: 0;
    }
    .sidebar h2 { color: #fff; margin-bottom: 2rem; text-align: center; }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: #fff;
      text-decoration: none;
      padding: 0.6rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      transition: background-color 0.3s;
      font-size: 14px;
    }
    .sidebar a:hover, .sidebar a.active { background-color: #1e90ff; }
    .sidebar i { width: 20px; text-align: center; }

    .main {
      margin-left: 220px;
      padding: 2rem;
      width: calc(100% - 220px);
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      background-color: #f0f0f0;
    }
    .welcome { grid-column: span 3; background-color: #fff; padding: 1rem 2rem; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .welcome span { font-size: 1.2rem; }
    .card { background-color: #fff; padding: 1rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .add-flight { grid-column: span 2; display: flex; gap: 1rem; align-items: center; }
    .add-flight img { width: 200px; border-radius: 10px; }
    .add-flight-form { flex: 1; display: flex; flex-direction: column; gap: 0.6rem; }
    .add-flight-form input, .add-flight-form select { padding: 0.6rem; border: 1px solid #ccc; border-radius: 6px; }
    .add-flight-form button { padding: 0.8rem; background-color: #004080; color: #fff; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s; }
    .add-flight-form button:hover { background-color: #1e90ff; }
    .stats { display: flex; flex-direction: column; gap: 1rem; }
    .stats .stat { background-color: #fff; padding: 1rem; border-radius: 10px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .weather, .flights, .profile { background-color: #fff; padding: 1rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .weather h3, .flights h3, .profile h3 { margin-bottom: 1rem; color: #333; }
    .profile img { width: 80px; height: 80px; border-radius: 50%; margin-bottom: 0.5rem; }
    .profile p { margin: 0.3rem 0; font-size: 0.9rem; color: #555; }
    .upcoming-flight { background-color: #f9f9f9; padding: 0.6rem; border-radius: 8px; margin-bottom: 0.5rem; }
    .upcoming-flight span { display: block; font-size: 0.85rem; margin-top: 0.2rem; color: #555; }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>✈ Airlines</h2>
    <a href="dashboard.php" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>
    <a href="flight.php"><i class="fas fa-plane"></i> Flights Details</a>
    <a href="map.php"><i class="fas fa-map"></i> Map</a>
    <a href="request.php"><i class="fas fa-paper-plane"></i> Request</a>
    <div style="flex:1"></div>
    <a href="support.php"><i class="fas fa-headset"></i> Support</a>
    <a href="atcprofile.php"><i class="fas fa-cog"></i> Settings</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="main">
    <div class="welcome">
      <span>👋 Hello! Mr. <?= htmlspecialchars($username) ?></span>
    </div>

    <div class="add-flight card">
      <img src="plane.png" alt="Pesawat">
      <form class="add-flight-form" action="submit_flight.php" method="post">
        <h3>Welcome to dashboard</h3>
        <h2 style="color:#001f4d;">Add a Flight</h2>
        <input type="text" name="from" placeholder="From" required>
        <input type="text" name="to" placeholder="To" required>

        <select name="flight_number" required>
          <option value="">Select Flight Number</option>
          <?php while ($row = mysqli_fetch_assoc($flight_numbers)) { ?>
            <option value="<?= $row['flight_number'] ?>"><?= $row['flight_number'] ?></option>
          <?php } ?>
        </select>

        <select name="runway_id" required>
        <option value="" disabled selected>Select Runway</option>
       <?php $runway_query = $koneksi->query("SELECT code, status FROM runways"); while ($runway = $runway_query->fetch_assoc()) {
        $code = htmlspecialchars($runway['code']);
        $status = htmlspecialchars($runway['status']);
        echo "<option value=\"$code\">$code ($status)</option>";
     }
   ?>
  </select>
        <label for="departure">Departure Date & Time:</label>
        <input type="datetime-local" name="departure" id="departure" required>
        <label for="arrival">Arrival Date & Time:</label>
        <input type="datetime-local" name="arrival" id="arrival" required>
        <button type="submit">Add Flight</button>
      </form>
    </div>
    <?php
// Ambil data count berdasarkan status dari tabel flight_requests
$counts = [
    'Requested' => 0,
    'Accepted' => 0,
    'Rejected' => 0,
];

$query = "SELECT status, COUNT(*) as total FROM flight_requests GROUP BY status";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $status = $row['status'];
    $total = $row['total'];
    $counts[$status] = $total;
}
?>
    <div class="stats">
  <div class="stat">
    <h2><?= $counts['Requested'] ?></h2>
    <p>Flights Booked</p>
    <i class="fas fa-calendar-alt fa-2x"></i>
  </div>
  <div class="stat">
    <h2><?= $counts['Accepted'] ?></h2>
    <p>Flights Done</p>
    <i class="fas fa-check fa-2x" style="color:green;"></i>
  </div>
  <div class="stat">
    <h2><?= $counts['Rejected'] ?></h2>
    <p>Flights Cancelled</p>
    <i class="fas fa-times fa-2x" style="color:red;"></i>
  </div>
</div>


    <div class="weather card">
      <h3>May 17 - Weather Report</h3>
      <p><strong>Prague</strong></p>
      <p>Wednesday - <span style="color:green;">No Risk</span></p>
      <p>🌤 16°</p>
      <p>May 16 - 🌧 12° <span style="color:red;">High Risk</span></p>
      <p>May 15 - ☀️ 39° <span style="color:orange;">Low Risk</span></p>
    </div>

    <div class="flights card">
  <h3>Upcoming Flights</h3>
  <?php
    $query = $koneksi->query("SELECT departure_place, destination, departure_date FROM flight_requests WHERE status = 'Accepted' ORDER BY departure_date ASC LIMIT 5");

    if ($query->num_rows > 0) {
      while ($row = $query->fetch_assoc()) {
        $tanggal = date("D d M, Y", strtotime($row['departure_date']));
        $jam = date("H:i", strtotime($row['departure_date']));
        echo '<div class="upcoming-flight">';
        echo '<strong>' . $tanggal . '</strong>';
        echo '<span>' . htmlspecialchars($row['departure_place']) . ' → ' . htmlspecialchars($row['destination']) . '</span>';
        echo '</div>';
      }
    } else {
      echo "<p>No upcoming flights.</p>";
    }
  ?>
</div>

    <div class="profile card">
      <h3>ATC Profile</h3>
      <img src="profile.png" alt="Profile">
      <p><strong><?= htmlspecialchars($username) ?></strong></p>
  </div>
</body>
</html>
