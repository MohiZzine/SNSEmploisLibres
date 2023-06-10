<?php session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
  exit();
}
require_once("../utils/database.php");
// require_once '../classes/database.class.php';
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
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include '../includes/dashboard_header.php'; ?>
      <div class="container-fluid">

            <div class="card-container">
              <h2 class="text-center p-3 m-2">Devis</h2>
              <h4>What the artisan will do</h4>

              <?php
              $ConnectingDB = $GLOBALS['pdo'];
              $artisan_services = $ConnectingDB->query("SELECT * FROM artisan_services");
              $artisan_service = $artisan_services->fetch(PDO::FETCH_ASSOC)) 
                ?>
                <div class="card">
                  <form method="post" action="views/services.php">
                    <input type="hidden" name="service_id" value="<?php echo $s["service_id"]; ?>">
                    <button type="submit" id="service" name="service" class="btn">
                      <?php echo "<h4>". $s['service_name'].'</h4></br>'. $s['service_description']; ?>
                    </button>
                  </form>
                </div>

              <?php ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>

  <?php include '../includes/footer.php'; ?>