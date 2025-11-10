<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CineFlick Login</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="background"></div>

  <!-- 🔹 Logo di pojok kiri atas -->
  <header class="header">
    <img src="CineFlick.png" alt="CineFlick Logo" class="logo-img" />
  </header>

  <div class="container">
    <div class="login-box">
      <h2>Hai Ketemu Lagi Di CineFlick!</h2>
      <form id="loginForm">
        <input type="email" placeholder="Email" required />
        <input type="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>

      <div class="links">
        <p>Belum Punya Akun? <a href="#">Daftar</a></p>
        <a href="#">Lupa Password?</a>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
