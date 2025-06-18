<?php
session_start();
include "../koneksi.php"; // Pastikan koneksi.php ada di folder projekrbpl

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek ke tabel ATC, sesuaikan nama tabel & kolom jika berbeda
    $query = "SELECT * FROM atc_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
    $data = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $data['username'];
    $_SESSION['atc_id']   = $data['id']; // pastikan kolom di tabel atc_users adalah 'id'
    
    header("Location: ../atc/dashboard.php");
    exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Adventure Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
    body {
      background: #0a0a0a;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
    }
    .container {
      position: relative;
      width: 740px;
      height: 460px;
    }
    .background-image-container {
      position: absolute;
      top: -30px;
      left: 0;
      width: 100%;
      height: 460px;
      background: url('image.png') center/cover no-repeat;
      border-radius: 16px;
      opacity: 0.7;
      z-index: 0;
    }
    .login-box {
      position: relative;
      width: 100%;
      height: 100%;
      border-radius: 20px;
      overflow: hidden;
      z-index: 2;
    }
    .background-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(5px);
      z-index: 1;
    }
    .content {
      position: relative;
      z-index: 2;
      padding: 2rem;
      color: #fff;
      display: flex;
      flex-direction: column;
    }
    .content h2 {
      font-size: 1.6rem;
      font-weight: bold;
      margin-bottom: 2rem;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }
    label {
      font-size: 0.9rem;
      color: #ccc;
    }
    .input-group {
      display: flex;
      align-items: center;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding: 0.6rem;
    }
    .input-group i {
      margin-right: 0.6rem;
      color: #bbb;
    }
    .input-group input {
      flex: 1;
      background: transparent;
      border: none;
      outline: none;
      color: #fff;
      font-size: 1rem;
    }
    .forgot {
      text-align: right;
      font-size: 0.8rem;
      margin-top: -0.5rem;
    }
    .forgot a {
      color: #ccc;
      text-decoration: none;
    }
    .start-button {
      text-align: center;
      margin-top: 1.5rem;
    }
    .start-button button {
      background-color: #0077aa;
      border: none;
      padding: 0.7rem 1.5rem;
      color: white;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .start-button button:hover {
      background-color: #005f88;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="background-image-container"></div>
    <div class="login-box">
      <div class="background-overlay"></div>
      <div class="content">
        <h2>The adventure begins<br />with your login!</h2>

        <form method="POST" action="loginatc.php">
          <label>Username</label>
          <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required />
          </div>

          <label>Password</label>
          <div class="input-group">
            <i class="fas fa-key"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>

          <div class="forgot">
            <a href="#">Forgot Password?</a>
          </div>

          <div class="start-button">
            <button type="submit" name="login">Get started</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
