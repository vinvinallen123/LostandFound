<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost and Found System - Register</title>
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
      <div class="brand-badge">Lost & Found</div>

      <div class="hero-text">
        <h1>Find what matters.<br>Return what belongs.</h1>
        <p>
          A smart and simple lost and found system where users can register,
          report missing items, and help return found belongings faster.
        </p>
      </div>

      <div class="feature-cards">
        <div class="feature-card card1">
          <div class="icon">🔎</div>
          <div>
            <h3>Report Lost Items</h3>
            <p>Post details of your missing belongings in seconds.</p>
          </div>
        </div>

        <div class="feature-card card2">
          <div class="icon">📦</div>
          <div>
            <h3>Submit Found Items</h3>
            <p>Help others by reporting items you discovered.</p>
          </div>
        </div>

        <div class="feature-card card3">
          <div class="icon">⚡</div>
          <div>
            <h3>Fast Matching</h3>
            <p>Connect owners and finders through one clean platform.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="right-panel">
      <div class="form-box">
        <div class="form-top">
          <h2>Create Account</h2>
          <p>Join the user-side portal of the system</p>
        </div>

        <form action="#" method="POST">
          <div class="input-row">
            <div class="input-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" placeholder="Enter first name" maxlength ="49">
            </div>

            <div class="input-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" placeholder="Enter last name"  maxlength ="49">
            </div>
          </div>

          <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email"  maxlength ="49">
          </div>

          <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username"  maxlength ="49">
          </div>

          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password"  maxlength ="49">
          </div>

      <button type="button" class="register-btn" onclick="submitFunc()">Create Account</button>

          <p class="login-link">
            Already have an account? <a href="loginPage.php">Sign in</a>
          </p>
        </form>
      </div>
    </div>

  </div>
<footer class="footer">
  <p>© Lost & Found System. Built with 💙 by Allen</p>
</footer>
</body>
<script src="../scripts/service.js"></script>
</html>