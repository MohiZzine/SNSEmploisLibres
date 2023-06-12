<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('location: ../index.php');
  exit;
} else {
  if ($_SESSION['user_role'] == 'artisan') {
    header('location: dashboardArtisan.php');
    exit;
  }
}
require_once("../utils/database.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SNS Emplois Libres</title>
  <!-- <link rel="stylesheet" href="styles/main.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="../styles/dashboard.css" />
  <link rel="stylesheet" href="../styles/cards.css" />
  <link rel="stylesheet" href="../styles/notifications.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include '../includes/dashboard_header.php'; ?>
    <!--  Header End -->
    <div class="container-fluid">

      <div class="card-container">
        <?php
        $ConnectingDB = $GLOBALS['pdo'];
        $service = $ConnectingDB->query("SELECT * FROM services");
        while ($s = $service->fetch(PDO::FETCH_ASSOC)) {
          ?>

          <div class="card m-3 mx-2">

            <form method="post" action="services.php">
              <input type="hidden" name="service_id" value="<?php echo $s["service_id"]; ?>">
              <button type="submit" id="service" name="service" class="btn">
                <?php echo "<h4>" . $s['service_name'] . '</h4></br>' . $s['service_description']; ?>
              </button>
            </form>

          </div>
        <?php } ?>
      </div>
      <div style="">
        <?php
        $notification = $ConnectingDB->query("SELECT * FROM notifications NATURAL JOIN requests WHERE user_id='$_SESSION[user_id]' AND is_read=0 ORDER BY date_sent DESC;");
        echo '<div class="notification-ui_dd-content">';
        while ($n = $notification->fetch(PDO::FETCH_ASSOC)) {
          $artisan = $ConnectingDB->query("SELECT * FROM artisans WHERE artisan_id='$n[artisan_id]'");
          $artisan = $artisan->fetch(PDO::FETCH_ASSOC);
          $artisan_as_a_user = $ConnectingDB->query("SELECT * FROM users WHERE user_id=" . $artisan['user_id']);
          $artisan_as_a_user = $artisan_as_a_user->fetch(PDO::FETCH_ASSOC);
          $subservice = $ConnectingDB->query("SELECT * FROM subservices WHERE subservice_id='$n[subservice_id]'");
          $subservice = $subservice->fetch(PDO::FETCH_ASSOC);
          $service = $ConnectingDB->query("SELECT * FROM services WHERE service_id='$subservice[service_id]'");
          $service = $service->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="notification-list notification-list--unread">
            <div class="notification-list_content">
              <div class="notification-list_img"> <img src="<?php echo $artisan["profile_picture"]; ?>" alt="artisan">
              </div>
              <div class="notification-list_detail">
                <p><b>
                    <?php echo $artisan_as_a_user["full_name"]; ?>
                  </b></p>
                <p class="text-muted"><small><b>Request: </b>
                    <?php echo $subservice["subservice_name"]; ?>
                  </small></p>
                <p class="text-muted"><small><b>Service: </b>
                    <?php echo $service["service_name"]; ?>
                  </small></p>
                <p class="text-muted">
                  <?php echo $n["message"]; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

  <?php include '../includes/footer.php'; ?>