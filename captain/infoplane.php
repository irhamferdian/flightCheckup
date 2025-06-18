<?php
include 'auth.php';
include '../koneksi.php';

$pilot_id = $_SESSION['pilot_id'];
$plane = null;

// Ambil data pesawat
$stmt = $koneksi->prepare("SELECT * FROM planes WHERE pilot_id = ?");
$stmt->bind_param("i", $pilot_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $plane = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Plane Info</title>
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

    .icon-group i:hover {
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
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      color: #1a1a1a;
    }

    .back-button {
      font-size: 1rem;
      margin-bottom: 2rem;
      background-color: white;
      border-radius: 12px;
      padding: 0.5rem 1.2rem;
      width: fit-content;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .content {
      background-color: white;
      border-radius: 16px;
      padding: 2rem;
      display: flex;
      gap: 2rem;
    }

    .plane-card, .edit-form {
      flex: 1;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 1.5rem;
    }

    .plane-card h2 {
      font-size: 1.2rem;
      margin-bottom: 1rem;
    }

    .plane-image {
      width: 100%;
      height: 160px;
      border-radius: 8px;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      row-gap: 0.8rem;
      font-size: 0.95rem;
    }

    .info-grid div {
      display: flex;
      flex-direction: column;
    }

    .info-grid span:first-child {
      font-weight: 600;
      color: #888;
      font-size: 0.8rem;
    }

    .edit-form h3 {
      margin-bottom: 0.5rem;
    }

    .edit-form p {
      margin-bottom: 1rem;
      font-size: 0.85rem;
      color: #666;
    }

    .edit-form input {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      border: none;
      background-color: #f2f4f7;
    }

    .edit-form button {
      width: 100%;
      padding: 0.6rem;
      background-color: #003366;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .edit-form button:hover {
      background-color: #00509e;
    }
    .back-button {
  font-size: 1rem;
  margin-bottom: 2rem;
  background-color: white;
  border-radius: 12px;
  padding: 0.5rem 1.2rem;
  width: fit-content;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  color: inherit;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}
    .icon-group a i {
  font-size: 1.2rem;
  color: #1a1a1a;
  padding: 0.6rem;
  border-radius: 8px;
  transition: background-color 0.3s;
  cursor: pointer;
  display: inline-block;
}

.icon-group a i:hover {
  background-color: #1e90ff;
  color: white;
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
  </style>
</head>
<body>
  <?php if (isset($_GET['success'])): ?>
  <script>alert("Data pesawat berhasil diperbarui!");</script>
  <?php endif; ?>

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
  <a href="dashboard.php" class="back-button">
    <i class="fas fa-arrow-left"></i> Back
  </a>

  <div class="content">
    <?php if ($plane): ?>
      <div class="plane-card">
        <h2><?php echo htmlspecialchars($plane['model']); ?></h2>
        <img src="<?php echo !empty($plane['image']) ? htmlspecialchars($plane['image']) : 'fotopesawat.png'; ?>" alt="Plane" class="plane-image"/>
        <div class="info-grid">
          <div>
            <span>Tail No.</span>
            <span><?php echo htmlspecialchars($plane['tail_no'] ?? '--'); ?></span>
          </div>
          <div>
            <span>Flight Number</span>
            <span><?php echo htmlspecialchars($plane['flight_number'] ?? '--'); ?></span>
          </div>
          <div>
            <span>Age</span>
            <span><?php echo htmlspecialchars($plane['age'] ?? '--'); ?></span>
          </div>
          <div>
            <span>Call Sign</span>
            <span><?php echo htmlspecialchars($plane['call_sign'] ?? '--'); ?></span>
          </div>
          <div>
            <span>Range</span>
            <span><?php echo htmlspecialchars($plane['range_miles'] ?? '--'); ?> mi</span>
          </div>
          <div>
            <span>First Flight</span>
            <span><?php echo htmlspecialchars($plane['first_flight'] ?? '--'); ?></span>
          </div>
        </div>
      </div>

      <div class="edit-form">
        <h3>Edit Plane detail</h3>
        <p>Update plane information</p>
        <form method="POST" action="update_plane.php" enctype="multipart/form-data">
          <input type="hidden" name="plane_id" value="<?php echo htmlspecialchars($plane['id']); ?>" />
          <input type="text" name="tail_no" placeholder="Tail No" value="<?php echo htmlspecialchars($plane['tail_no']); ?>" />
          <input type="text" name="flight_number" placeholder="Flight Number" value="<?php echo htmlspecialchars($plane['flight_number']); ?>" />
          <input type="text" name="call_sign" placeholder="Call Sign" value="<?php echo htmlspecialchars($plane['call_sign']); ?>" />
          <input type="number" name="age" placeholder="Age" value="<?php echo htmlspecialchars($plane['age']); ?>" />
          <input type="text" name="range_miles" placeholder="Range (in miles)" value="<?php echo htmlspecialchars($plane['range_miles']); ?>" />
          <input type="date" name="first_flight" placeholder="First Flight" value="<?php echo htmlspecialchars($plane['first_flight']); ?>" />
          <button type="submit">Update</button>
        </form>
      </div>
    <?php else: ?>
      <div style="padding: 2rem; background: white; border-radius: 12px;">
        <p style="color: #333;">Belum ada data pesawat untuk akun ini. Silakan hubungi admin atau tambahkan data pesawat terlebih dahulu.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
