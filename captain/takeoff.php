<!DOCTYPE html>
<?php 
include 'auth.php';
include '../koneksi.php';

$pilot_id = $_SESSION['pilot_id'];

// Cek apakah pilot memiliki pesawat
$query_plane = mysqli_query($koneksi, "SELECT * FROM planes WHERE pilot_id = '$pilot_id' LIMIT 1");
$plane = mysqli_fetch_assoc($query_plane);
$can_request = $plane ? true : false;

$from_query = mysqli_query($koneksi, "SELECT DISTINCT departure_place FROM flights WHERE departure_place IS NOT NULL");
$froms = [];
while ($row = mysqli_fetch_assoc($from_query)) {
  $froms[] = $row['departure_place'];
}

$to_query = mysqli_query($koneksi, "SELECT DISTINCT destination FROM flights WHERE destination IS NOT NULL");
$destinations = [];
while ($row = mysqli_fetch_assoc($to_query)) {
  $destinations[] = $row['destination'];
}

$runway_query = mysqli_query($koneksi, "SELECT * FROM runways WHERE status = 'available'");
$runways = [];
while ($row = mysqli_fetch_assoc($runway_query)) {
  $runways[] = $row;
}

$request_query = mysqli_query($koneksi, "
   SELECT fr.*, r.code AS runway_code, p.airline
  FROM flight_requests fr
  JOIN planes p ON p.id = fr.plane_id
  LEFT JOIN runways r ON r.id = fr.requested_runway_id
  WHERE p.pilot_id = '$pilot_id'
  ORDER BY fr.request_time DESC
  LIMIT 1
");
$request = mysqli_fetch_assoc($request_query);
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Takeoff Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body { display: flex; min-height: 100vh; background-color: #0e0e0e; }
    .sidebar { width: 70px; background-color: #ffffff; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 1rem 0; }
    .icon-group { display: flex; flex-direction: column; gap: 1.5rem; }
    .icon-group a i { font-size: 1.2rem; color: #1a1a1a; padding: 0.6rem; border-radius: 8px; transition: background-color 0.3s; cursor: pointer; }
    .icon-group a i:hover { background-color: #1e90ff; color: white; }
    .bottom { display: flex; flex-direction: column; align-items: center; gap: 1rem; }
    .profile { width: 40px; height: 40px; border-radius: 50%; background-color: #1e90ff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
    .main-container { flex: 1; padding: 2rem; display: flex; flex-direction: column; color: #1a1a1a; }
    .cockpit-image { width: 100%; max-height: 300px; border-radius: 12px; object-fit: cover; margin-bottom: 2rem; }
    .request-container { background-color: white; border-radius: 16px; padding: 2rem; display: flex; flex-direction: column; }
    .tab-header { display: flex; border-bottom: 2px solid #ccc; margin-bottom: 1.5rem; }
    .tab-header div { padding: 0.5rem 1rem; cursor: pointer; font-weight: bold; color: #555; }
    .tab-header .active { border-bottom: 3px solid #1e90ff; color: #1e90ff; }
    .hidden { display: none; }
    form, .status-section { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; align-items: end; }
    form div, .status-section div { display: flex; flex-direction: column; }
    label { font-size: 0.9rem; margin-bottom: 0.5rem; }
    select, input[type="date"] { padding: 0.6rem; border-radius: 8px; border: 1px solid #ccc; background-color: #f2f4f7; }
    button { padding: 0.6rem; background-color: #1e90ff; color: white; font-weight: bold; border: none; border-radius: 8px; cursor: pointer; }
    button:hover { background-color: #005bb5; }
    .badge { padding: 0.4rem 0.8rem; border-radius: 12px; font-size: 0.8rem; font-weight: bold; text-align: center; width: fit-content; }
    .requested { background-color: #ffa500; color: white; }
    .accepted { background-color: #28a745; color: white; }
    .rejected { background-color: #dc3545; color: white; }
    .alert-box { background-color: #fffbe6; padding: 2rem; border-radius: 12px; border: 1px solid #ffe58f; color: #614700; margin: 2rem; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .alert-box h2 { margin-bottom: 1rem; }
    .alert-box a { margin-top: 1rem; text-decoration: none; padding: 0.6rem 1rem; background-color: #1e90ff; color: white; border-radius: 8px; }
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
<?php if (!$can_request): ?>
<div class="alert-box">
  <h2>Anda belum memiliki pesawat</h2>
  <p>Silakan hubungi ATC untuk penetapan pesawat terlebih dahulu.</p>
  <a href="dashboard.php">Kembali ke Dashboard</a>
</div>
<?php else: ?>
<div class="main-container">
  <img src="kokpit.png" alt="Cockpit" class="cockpit-image"/>
  <div class="request-container">
    <div class="tab-header">
      <div id="tab-request" class="tab active">Request</div>
      <div id="tab-status" class="tab">Check your request status</div>
    </div>

    <form id="request-form" method="POST" action="proses_request.php">
      <div>
        <label for="from"><i class="fas fa-plane-departure"></i> From</label>
        <select id="from" name="from" required>
          <option value="">Select Departure...</option>
          <?php foreach ($froms as $from): ?>
            <option value="<?= htmlspecialchars($from) ?>"><?= htmlspecialchars($from) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="to"><i class="fas fa-plane-arrival"></i> To</label>
        <select id="to" name="to" required>
          <option value="">Select Destination...</option>
          <?php foreach ($destinations as $dest): ?>
            <option value="<?= htmlspecialchars($dest) ?>"><?= htmlspecialchars($dest) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="date">Departure Date</label>
        <input type="date" id="date" name="date" required />
      </div>
      <div>
        <label for="runway">Runway</label>
        <select id="runway" name="runway" required>
          <option value="">Select Runway...</option>
          <?php foreach ($runways as $runway): ?>
            <option value="<?= $runway['id'] ?>"><?= $runway['code'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div></div>
      <div><button type="submit">Request</button></div>
    </form>

    <div id="status-section" class="status-section hidden">
  <div>
    <label>From</label>
    <span><?= $request['departure_place'] ?? '-' ?></span>
  </div>
  <div>
    <label>To</label>
    <span><?= $request['destination'] ?? '-' ?></span>
  </div>
  <div>
    <label>Departure Date</label>
    <span><?= isset($request['departure_date']) ? date('l, F j, Y', strtotime($request['departure_date'])) : '-' ?></span>
  </div>
  <div>
    <label>Airline</label>
    <span><?= $request['airline'] ?? '-' ?></span>
  </div>
  <div>
    <label>Runway</label>
    <span><?= $request['runway_code'] ?? '-' ?></span>
  </div>
  <div>
    <label>Status</label>
    <span class="badge <?= strtolower($request['status'] ?? '') ?>">
      <?= $request['status'] ?? '-' ?>
    </span>
    </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script>
  const tabRequest = document.getElementById('tab-request');
  const tabStatus = document.getElementById('tab-status');
  const form = document.getElementById('request-form');
  const statusSection = document.getElementById('status-section');

  tabRequest?.addEventListener('click', () => {
    tabRequest.classList.add('active');
    tabStatus.classList.remove('active');
    form?.classList.remove('hidden');
    statusSection?.classList.add('hidden');
  });

  tabStatus?.addEventListener('click', () => {
    tabStatus.classList.add('active');
    tabRequest.classList.remove('active');
    form?.classList.add('hidden');
    statusSection?.classList.remove('hidden');
  });
</script>
</body>
</html>
