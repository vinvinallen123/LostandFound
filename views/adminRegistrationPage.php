<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Portal - Register</title>

  <link rel="stylesheet" href="../styles/registrationStyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

      <div class="brand-badge">Admin Portal</div>

      <div class="hero-text">
        <h1>Admin Access<br>System Control Panel</h1>
        <p>
          This portal is restricted to administrators for managing users,
          reports, and system-wide lost and found records.
        </p>
      </div>

      <div class="feature-cards">

        <div class="feature-card card1">
          <div class="icon">🔎</div>
          <div>
            <h3>Manage Reports</h3>
            <p>Monitor and control all submitted lost and found items.</p>
          </div>
        </div>

        <div class="feature-card card2">
          <div class="icon">📦</div>
          <div>
            <h3>User Management</h3>
            <p>Oversee registered users and system activity.</p>
          </div>
        </div>

        <div class="feature-card card3">
          <div class="icon">⚡</div>
          <div>
            <h3>System Control</h3>
            <p>Maintain full administrative control over the platform.</p>
          </div>
        </div>

      </div>

    </div>

    <div class="right-panel">

      <div class="form-box">

        <div class="form-top">
          <h2>Admin Registration</h2>
          <p>Create an administrator account for system access</p>
        </div>

        <form action="#" method="POST">

          <div class="input-row">

            <div class="input-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" placeholder="Enter first name" maxlength="49">
            </div>

            <div class="input-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" placeholder="Enter last name" maxlength="49">
            </div>

          </div>

          <div class="input-group">
            <label for="email">Admin Email</label>
            <input type="email" id="email" name="email" placeholder="Enter admin email" maxlength="49">
          </div>

          <div class="input-group">
            <label for="username">Admin Username</label>
            <input type="text" id="username" name="username" placeholder="Choose admin username" maxlength="49">
          </div>

          <div class="input-group">
            <label for="password">Admin Password</label>
            <input type="password" id="password" name="password" placeholder="Enter admin password" maxlength="49">
          </div>

          <button type="button" class="register-btn" onclick="adminSubmitFunc()">
            Create Admin Account
          </button>

          <p class="login-link">
            Already have an admin account? <a href="adminLoginPage.php">Sign in</a>
          </p>

        </form>

      </div>

    </div>

  </div>

  <footer class="footer">
    <p>© Admin Portal. Built with 💙 by Allen</p>
  </footer>

</body>

<script src="../scripts/adminService.js"></script>
</html>