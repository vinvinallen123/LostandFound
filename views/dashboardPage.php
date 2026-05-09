<?php
session_start();
require_once "../BL/logManager.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: loginPage.php");
    exit;
}

$logmanager = new logManager();
$logs = $logmanager->getLogsFunc();

// ✅ chart data (same style as your prof)
$reports = $logmanager->getDailyReportsFunc();
$labels = array_column($reports, 'day_name');
$data = array_column($reports, 'total');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Lost and Found</title>
  <link rel="stylesheet" href="../styles/dashboardStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- libs -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <div class="bg-animation"></div>
  <div class="floating orb1"></div>
  <div class="floating orb2"></div>
  <div class="floating orb3"></div>
  <div class="grid-overlay"></div>

  <div class="dashboard-wrapper">

    <aside class="sidebar">
      <div class="logo">Lost & Found</div>

      <nav class="nav-menu">
        <a href="#" class="nav-item active">Dashboard</a>
      </nav>

      <div class="sidebar-footer">
        <a href="loginPage.php" class="logout-btn">Logout</a>
      </div>
    </aside>

    <main class="main-content">
      <div class="welcome-box">
        <h1>Hello, <?php echo $_SESSION["first_name"]; ?>!</h1>
        <p>Report an item and check the current missing items list.</p>
      </div>

      <div class="dashboard-grid">

        <!-- ADD ITEM FORM -->
        <div class="floating-form-box">
          <div class="form-header">
            <div class="icon-box">📦</div>
            <div>
              <h2>Add Item</h2>
              <p>Fill in the details of the item.</p>
            </div>
          </div>

          <form action="#" method="POST" class="item-form">
            <div class="input-group">
              <label>Item Name</label>
              <input type="text" id="itemName" placeholder="Enter item name">
            </div>

            <div class="input-group">
              <label>Item Description</label>
              <textarea id="itemDesc" rows="4" placeholder="Describe the item"></textarea>
            </div>

            <div class="input-group">
              <label>Item Status</label>
              <select id="itemStatus">
                <option disabled selected>Select status</option>
                <option value="Missing">Missing</option>
              </select>
            </div>

            <button type="button" class="submit-btn" onclick="submitItem()">Submit Item</button>
          </form>
        </div>

        <!-- TABLE -->
        <div class="list-box">
          <div class="list-header">
            <div class="icon-box">📋</div>
            <div>
              <h2>Missing Items</h2>
              <p>Current list of reported items from the database.</p>
            </div>
          </div>

          <div class="table-wrapper">
            <table class="items-table">
              <thead>
                <tr>
                  <th>Item Name</th>
                  <th>Description</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($logs)) : ?>
                  <?php foreach ($logs as $log) : ?>
                    <tr>
                      <td><?php echo $log["item_name"]; ?></td>
                      <td><?php echo $log["item_desc"]; ?></td>
                      <td><?php echo $log["item_status"]; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="3">No items found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- ✅ CHART -->
      <div style="width:100%; max-width:600px; margin:30px auto;">
        <canvas id="myChart"></canvas>
      </div>

    </main>
  </div>

  <footer class="footer">
    <p>© Lost and Found Tracker. Built with 💙 by Allen</p>
  </footer>

  <!-- ✅ Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  
  <script>
  window.barData = {
      labels: <?php echo json_encode($labels); ?>,
      data: <?php echo json_encode($data); ?>
  };
  </script>

  <!-- ✅ your JS -->
  <script src="../scripts/logService.js"></script>

</body>
</html>