<?php
session_start();
require_once "../BL/logManager.php";

$logmanager = new logManager();

$logs = $logmanager->getLogsFunc();
$itemsPerDay = $logmanager->getItemsPerDay();
$weeklyReports = $logmanager->getReportsByDayName();

$missingCount = 0;
$claimedCount = 0;

foreach ($logs as $log) {
  if ($log["item_status"] === "Missing") $missingCount++;
  if ($log["item_status"] === "Claimed") $claimedCount++;
}
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

  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <div class="bg-animation"></div>

  <div class="dashboard-wrapper">

    <aside class="sidebar">
      <div class="sidebar-footer">
        <a href="adminLoginPage.php" class="logout-btn">Logout</a>
      </div>
    </aside>

    <main class="main-content">

      <div class="welcome-box">
        <h1>Admin Dashboard</h1>
        <p>Manage the lost and found item records here.</p>
      </div>

      
      <div class="stats-box">

        <div class="stat-card">
          <h3>Total Reports</h3>
          <span><?= count($logs) ?></span>
        </div>

        <div class="stat-card">
          <h3>Missing Items</h3>
          <span><?= $missingCount ?></span>
        </div>

        <div class="stat-card">
          <h3>Claimed Items</h3>
          <span><?= $claimedCount ?></span>
        </div>

      </div>

      
      <div class="manage-box">
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
                    <button class="update-btn" onclick="changeStatus(<?= $log['log_id'] ?>)">Update</button>
                    <button class="update-btn delete-btn" onclick="removeLogFunc(<?= $log['log_id'] ?>)">Delete</button>
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

    <div class="charts-wrapper">

  <div class="chart-card">
    <h3>Items Per Day</h3>
    <canvas id="chart1"></canvas>
  </div>

  <div class="chart-card">
    <h3>Weekly Reports</h3>
    <canvas id="chart2"></canvas>
  </div>

  <div class="chart-card">
    <h3>Status Overview</h3>
    <canvas id="chart3"></canvas>
  </div>

</div>
    </main>
  </div>

  <footer class="footer">
    <p>© Lost and Found Tracker</p>
  </footer>
<script>
window.labels = <?= json_encode(array_column($itemsPerDay, 'report_date')) ?>;
window.data = <?= json_encode(array_column($itemsPerDay, 'total')) ?>;

window.weekLabels = <?= json_encode(array_column($weeklyReports, 'day_name')) ?>;
window.weekData = <?= json_encode(array_column($weeklyReports, 'total')) ?>;

window.statusData = [<?= $missingCount ?>, <?= $claimedCount ?>];
</script>

 

<script src="../scripts/logService.js"></script>
<script src="../scripts/adminService.js"></script>

</body>
</html>