<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
require_once("../utils/database.php");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet"
    href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script
    src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
  <title>Devis</title>
  <link rel="stylesheet" href="../styles/dashboard.css" />
  <link rel="stylesheet" href="../styles/cards.css" />
  <link rel="stylesheet" href="../styles/modalDevis.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include '../includes/dashboard_header.php'; ?>
    <div class="container-fluid">
      <h2 class="text-center p-3 m-2">Devis</h2>
      <h4>What the artisan will do</h4>

      <?php
      $ConnectingDB = $GLOBALS['pdo'];
      $artisan_services = $ConnectingDB->query("SELECT * FROM artisan_services WHERE artisan_id =  " . $_POST['artisan_id'] . " AND subservice_id = " . $_POST['subservice_id']);
      $artisan_service = $artisan_services->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="d-flex align-items-center justify-content-between gap-2">
        <p>Price</p>
        <p>
          <?php echo $artisan_service['price'] ?>
        </p>
      </div>
      <div class="card">
        <button name="rdv" id="rdv">Demander une intervention</button>
        <!-- The Modal -->
        <div id="Modalrdv" class="modal">
          <div class="modal-content">
            <span class="close" style="color:black; position:absolute; right: 11px; top:0;">&times;</span>
            <form method="post" action="x.php">
              <input type="hidden" name="subservice_id" value="<?php $_POST["subservice_id"]; ?>">
              <input type="hidden" name="artisan_id" value="<?php $_POST["artisan_id"]; ?>">
              <h3>Reservation</h3>
              <label for="artisan_availability">Availability of
                <?php echo $_POST["artisan_full_name"]; ?>
              </label><br>

              <!-- Select -->
              <select name="artisan_availability" id="artisan_availability">
                <option value=""></option>
                <?php
                $artisan_id = $_POST["artisan_id"];
                $q = "SELECT * 
                      FROM availabilities WHERE artisan_id = '$artisan_id'";
                $availabilities = $ConnectingDB->prepare($q);
                $availabilities->execute();
                while ($availability = $availabilities->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <option
                    value="<?php echo $availability["days"] . ";" . $availability["start_time"] . ";" . $availability["end_time"]; ?>">
                    <?php echo $availability["days"] . ", from " . $availability["start_time"] . " to " . $availability["end_time"]; ?>
                  </option>
                <?php } ?>
              </select><br>

              <!-- Reservation -->
              <?php
              $_SESSION['subservice_id'] = $_POST['subservice_id'];
              $_SESSION['artisan_id'] = $_POST['artisan_id'];
              ?>
              <input style="display:none;" type="text" id="reservation_date" name="reservation_date" readonly>
              <input style="display:none;" type="text" id="reservation_time" name="reservation_time" readonly>

              <button type="submit" name="submit" class="btn">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <script src="../assets/js/devis.js"></script>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>

  <?php include '../includes/footer.php'; ?>