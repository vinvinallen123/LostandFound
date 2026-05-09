<?php
session_start();
require_once "../BL/logManager.php";

$logmanager = new logManager();
$logs = $logmanager->getLogsFunc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Lost and Found</title>
  <link rel="stylesheet" href="../styles/adminDashboardStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../scripts/adminService.js"></script>
</head>
<body>

  <div class="bg-animation"></div>
  <div class="floating orb1"></div>
  <div class="floating orb2"></div>
  <div class="floating orb3"></div>
  <div class="grid-overlay"></div>

  <div class="dashboard-wrapper">

    <aside class="sidebar">
      <div class="logo">Admin Panel</div>

      <nav class="nav-menu">
        <a href="#" class="nav-item active">Dashboard</a>
      
      </nav>

      <div class="sidebar-footer">
        <a href="adminLoginPage.php" class="logout-btn">Logout</a>
      </div>
    </aside>

    <main class="main-content">
      <div class="welcome-box">
        <h1>Admin Dashboard</h1>
        <p>Manage the lost and found item records here.</p>
      </div>

      <div class="dashboard-grid">

        <div class="stats-box">
          <div class="stat-card">
            <h3>Total Reports</h3>
            <span><?= count($logs) ?></span>
          </div>

          <div class="stat-card">
            <h3>Missing Items</h3>
            <span>
              <?php
              $missingCount = 0;
              foreach ($logs as $log) {
                  if ($log["item_status"] === "Missing") {
                      $missingCount++;
                  }
              }
              echo $missingCount;
              ?>
            </span>
          </div>

          <div class="stat-card">
            <h3>Claimed Items</h3>
            <span>
              <?php
              $claimedCount = 0;
              foreach ($logs as $log) {
                  if ($log["item_status"] === "Claimed") {
                      $claimedCount++;
                  }
              }
              echo $claimedCount;
              ?>
            </span>
          </div>
        </div>

        <div class="manage-box">
          <div class="box-header">
            <div class="icon-box">🛠️</div>
            <div>
              <h2>Manage Submitted Items</h2>
              <p>Update user-submitted item records here.</p>
            </div>
          </div>

          <div class="table-wrapper">
            <table class="items-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Item Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>User ID</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($logs)) : ?>
                  <?php foreach ($logs as $log) : ?>
                    <tr>
                      <td><?= $log["log_id"] ?></td>
                      <td><?= $log["item_name"] ?></td>
                      <td><?= $log["item_desc"] ?></td>
                      <td><?= $log["item_status"] ?></td>
                      <td><?= $log["user_id"] ?></td>
                      <td>
                        <button
                          class="update-btn"
                          class="update-btn"
                          onclick="changeStatus(<?= $log['log_id'] ?>)">
                         Update Status
                        </button>

                        <button
                          class="update-btn"
                          onclick="removeLogFunc(<?= $log['log_id'] ?>)">
                          Delete
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="6">No items found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </main>

  </div>

  <footer class="footer">
    <p>© Lost and Found Tracker. Built with 💙 by Allen</p>
  </footer>
</body>
</html>
