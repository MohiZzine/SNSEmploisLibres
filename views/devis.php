<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
require_once("../utils/database.php");

$ConnectingDB = $GLOBALS['pdo'];

// If the user confirms the request
if (isset($_POST['confirm'])) {

    $user_id = $_SESSION["user_id"];
    $subservice_id = $_POST["subservice_id"];
    $artisan_id = $_POST["artisan_id"];

    $notification = "INSERT INTO requests(user_id, subservice_id, artisan_id) VALUES ('$user_id', '$subservice_id', '$artisan_id')";
    $stmt = $ConnectingDB->prepare($notification);
    $stmt->execute();

    if ($stmt) {
        echo "<script>alert('Request sent!')</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SNS Emplois Libres</title>
  <link rel="stylesheet" href="../styles/dashboard.css" />
  <link rel="stylesheet" href="../styles/cards.css" />
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
      <form method="post" action="">
        <input type="hidden" name="subservice_id" value="<?php $_POST["subservice_id"]; ?>">
        <input type="hidden" name="artisan_id" value="<?php $_POST["artisan_id"]; ?>">
        <button type="submit" name="confirm">Demander une intervention</button>
      </form>
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