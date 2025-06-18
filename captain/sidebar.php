<div class="sidebar">
  <div class="icon-group">
    <a href="dashboard.php" class="nav-link active"><i class="fas fa-th-large"></i></a>
    <a href="infoplane.php" class="nav-link"><i class="fas fa-plane"></i></a>
    <a href="takeoff.php" class="nav-link"><i class="fas fa-road"></i></a>
    <a href="runway.php" class="nav-link"><i class="fas fa-map-marker-alt"></i></a>
  </div>

  <div class="profile-section">
    <div class="profile">
      <?php echo strtoupper(substr($username, 0, 2)); ?>
    </div>
  </div>

  <div class="logout-section">
    <img src="profile.png" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;" />
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
  </div>
</div>
