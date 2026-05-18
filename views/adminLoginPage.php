<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost and Found System - Login</title>
  <link rel="stylesheet" href="../styles/loginStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <div class="bg-animation"></div>
  <div class="floating orb1"></div>
  <div class="floating orb2"></div>
  <div class="floating orb3"></div>
  <div class="grid-overlay"></div>

  <div class="container">

    <div class="left-panel">
      <div class="brand-badge">Lost & Found</div>

      <div class="hero-text">
        <h1>Welcome back.<br>Sign in securely.</h1>
        <p>
          Access your lost and found account to report missing items,
          check found belongings, and stay updated.
        </p>
      </div>

      <div class="feature-cards">
        <div class="feature-card">
          <div class="icon">🔐</div>
          <div>
            <h3>Secure Access</h3>
            <p>Your account keeps your reports and activity protected.</p>
          </div>
        </div>

        <div class="feature-card">
          <div class="icon">📍</div>
          <div>
            <h3>Track Reports</h3>
            <p>Monitor lost and found submissions in one place.</p>
          </div>
        </div>

        <div class="feature-card">
          <div class="icon">⚡</div>
          <div>
            <h3>Quick Actions</h3>
            <p>Login and continue reporting or claiming items faster.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="right-panel">
      <div class="form-box">
        <div class="form-top">
          <h2>Sign In</h2>
          <p>Login to your account</p>
        </div>

        <form action="#" method="POST">
          <div class="input-group">
            <label for="loginUsername">Username</label>
            <input type="text" id="loginUsername" name="loginUsername" placeholder="Enter your username">
          </div>

          <div class="input-group">
            <label for="loginPassword">Password</label>
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password">
   

          <button type="button" class="login-btn" onclick="adminLoginFunc()">Sign In</button>

          <p class="register-link">
            Don’t have an account? <a href="adminRegistrationPage.php">Create account</a>
          </p>
        </form>
      </div>
    </div>

  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../scripts/adminService.js"></script>
<footer class="footer">
   <p>© Lost and Found Tracker. Built with 💙 by Allen</p>
</footer>
</body>
</html>