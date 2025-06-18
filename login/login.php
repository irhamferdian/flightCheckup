<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login As</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      background-color: #000;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }
    .container {
      display: flex;
      gap: 60px;
      align-items: center;
      background-color: #111;
      padding: 40px;
      border-radius: 32px;
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
    }
    .image-box {
      background: url("image.png") center/cover no-repeat;
      width: 300px;
      height: 460px;
      border-radius: 140px;
    }
    .login-panel {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 20px;
      border-radius: 24px;
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(10px);
    }
    .login-panel h1 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 6px;
    }
    .login-panel p {
      font-size: 14px;
      margin-bottom: 30px;
      color: #ccc;
    }
    .role-box {
      background: linear-gradient(to right, #cfd9df 0%, #e2ebf0 100%);
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 12px;
      cursor: pointer;
      transition: transform 0.3s ease;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #000;
      font-weight: bold;
    }
    .role-box:hover {
      transform: scale(1.03);
    }
    .role-box span {
      font-size: 14px;
      color: #555;
      display: block;
    }
    .role-box.captain {
      background: linear-gradient(to right, #8e9eab, #eef2f3);
    }
    .role-box.controller {
      background: linear-gradient(to right, #8E2DE2, #4A00E0, #00c6ff);
      color: white;
    }
    .role-box svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-box"></div>
    <div class="login-panel">
      <h1>Login As</h1>
      <p>welcome back we missed you</p>

      <!-- Captain Button -->
      <div class="role-box captain" onclick="location.href='logincaptain.php'">
        <div>
          <span>AIRLINE</span>
          Welcome Captain
        </div>
        <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
      </div>

      <!-- Controller Button -->
      <div class="role-box controller" onclick="location.href='loginatc.php'">
        <div>
          <span>AIRPORT</span>
          Air Traffic Controller
        </div>
        <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
      </div>

    </div>
  </div>
</body>
</html>
