<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit;
}

if ($_SESSION['user_role'] == 'artisan') {
  header("Location: dashboardArtisan.php");
  exit;
}

require_once "../utils/database.php";
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

      <div class="card-container" style="display: grid; grid-template-columns: 1fr 1fr;">
        <?php
        $ConnectingDB = $GLOBALS['pdo'];
        // $reviews = $ConnectingDB->query("SELECT *
        // FROM SELECT * FROM requests R JOIN artisans A ON R artisan_id = A.artisan_id WHERE R.user_id = {$_SESSION['user_id']}
        // ");
        $reviews = $ConnectingDB->query("SELECT * FROM artisans A JOIN requests R ON A.artisan_id = R.artisan_id WHERE R.user_id = '$_SESSION[user_id]'");
        while ($artisan = $reviews->fetch(PDO::FETCH_ASSOC)) {
          $artisans_reviews = $connectingDB->query("SELECT * FROM users WHERE user_id = '$artisan[user_id]'");
          $r = $artisans_reviews->fetch(PDO::FETCH_ASSOC);
          
          echo var_dump($r);

          ?>
          <div class="card m-3 mx-2" style="">

            <form method="post" action="services.php" style="width: 100%;">
              <input type="hidden" name="service_id" value="<?php echo $artisan["artisan_id"]; ?>">
              <button type="submit" id="service" name="service" class="btn" style="width: 100%; height: 200px;">
                <?php echo "<h1>" . $r['full_name'] . "</h1></br>" . "<p style='color: black'>" .$artisan['company_name'] . '</p>'; ?>
              </button>
            </form>

          </div>
        <?php } ?>
      </div>
    </div>
  </div>
 
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

  <?php include '../includes/footer.php'; ?>
