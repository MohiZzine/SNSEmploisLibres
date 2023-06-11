<?php
session_start();
require_once("../utils/database.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
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
    <!--  Header End -->
    <div class="container-fluid">

      <div class="card-container">

        <?php
        $ConnectingDB = $GLOBALS['pdo'];
        //$artisanId = $_GET['artisanId'];
        $artisanId = $_POST['artisan_id'];
        //join 3 tables
        //$artisan = $ConnectingDB->query("SELECT * FROM artisans where artisan_id = '$artisanId'");
        $artisan = $ConnectingDB->query("SELECT * FROM artisans JOIN users ON artisans.user_id = users.user_id  WHERE artisan_id =" . $artisanId);
        echo '<table class="artisan-table">';
        while ($a = $artisan->fetch(PDO::FETCH_ASSOC)) {
          echo '<tr><th colspan="2">Artisan Information</th></tr>';
          echo '<tr><td>Full name:</td><td>' . $a['full_name'] . '</td></tr>';
          if ($a["profile_picture"]) {
            echo '<tr><td>Profile picture:</td><td>' .
              '<img src="' . $a['profile_picture'] . '" alt="artisan">' . '</td></tr>';
          } else {
            echo '<tr><td>Profile picture:</td><td>' . '<img src="../assets/user.jpg" alt="artisan">' . '</td></tr>';
          }
          echo '<tr><td>Email:</td><td>' . $a['email'] . '</td></tr>';
          echo '<tr><td>Phone number:</td><td>' . $a['phone_number'] . '</td></tr>';
          echo '<tr><td>Company name:</td><td>' . $a['company_name'] . '</td></tr>';
          echo '<tr><td>Company address:</td><td>' . $a['company_address'] . '</td></tr>';
          echo '<tr><td>Description:</td><td>' . $a['description'] . '</td></tr>';
          echo '<tr><td>Certifications:</td><td>' . $a['certifications'] . '</td></tr>';
          echo '<tr><td>Location:</td><td>' . $a['location'] . '</td></tr>';

          $reviews = $ConnectingDB->query("SELECT * FROM reviews WHERE artisan_id = 1");
          if ($reviews->rowCount() > 0) {
            echo '<tr><th colspan="2">Reviews</th></tr>';
            while ($r = $reviews->fetch(PDO::FETCH_ASSOC)) {
              echo '<tr class="review"><td colspan="2">' . $r['review_text'] . '</td></tr>';
            }
          }
        }
        echo '</table>';
        echo '<form action="services.php" method="post">';
        echo '<input type="hidden" name="service_id" value=' . $_POST["service_id"] . '>';
        echo '<input type="hidden" name="subservice_id" value=' . $_POST["subservice_id"] . '>';
        echo '<input type="submit" value="Back">';
        echo '</form>';
        echo '<form method="post" action="devis.php">';
        echo '<input type="hidden" name="service_id" value=' . $_POST["service_id"] . '>';
        echo '<input type="hidden" name="subservice_id" value=' . $_POST["subservice_id"] . '>';
        echo '<input type="hidden" name="artisan_id" value=' . $_POST["artisan_id"] . '>';
        echo '<input type="submit" value="Choose">';
        echo '</form>';

        ?>


      </div>


    </div>
  </div>
  <!-- // button to go back to previous page -->

  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>

</body>

</html>

<?php include '../includes/footer.php'; ?>