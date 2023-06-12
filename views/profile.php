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
  <link rel="stylesheet" href="../styles/dashboard.css" />
  <link rel="stylesheet" href="../styles/cards.css" />
  <link rel="stylesheet" href="../styles/profile.css" />
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
        $a = $artisan->fetch(PDO::FETCH_ASSOC);
        echo '<div class="cv-container">';
        echo '<div class="cv-heading">';
        echo '<h1>Artisan profile</h1>';
        echo '</div>';

        echo '<div class="cv-picture">';
        if ($a["profile_picture"]) {
          echo '<img src="' . $a['profile_picture'] . '" alt="artisan" style="
            width: 210px;
            height: 200px;">';
        } else {
          echo '<img src="../assets/user.jpg" alt="artisan">';
        }

        echo '</div>';

        echo '<div class="cv-section">';
        echo '<div class="cv-section-heading">Personal Information</div>';
        echo '<div class="cv-section-content">';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Full Name:</span>';
        echo "<span class='cv-value'>";
        echo $a['full_name'];
        echo "</span>";
        echo '</div>';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Email:</span>';
        echo '<span class="cv-value">';
        echo $a['email'];
        echo '</span>';
        echo '</div>';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Phone Number:</span>';
        echo '<span class="cv-value">';
        echo $a['phone_number'];
        echo '</span>';
        echo '</div>';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Location:</span>';
        echo '<span class="cv-value">';
        echo $a['location'];
        echo '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="cv-section">';
        echo '<div class="cv-section-heading">Professional Experience</div>';
        echo '<div class="cv-section-content">';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Company Name:</span>';
        echo '<span class="cv-value">';
        echo $a['company_name'];
        echo '</span>';
        echo '</div>';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Company Address:</span>';
        echo '<span class="cv-value">';
        echo $a['company_address'];
        echo '</span>';
        echo '</div>';
        echo '<div class="cv-item">';
        echo '<span class="cv-label">Description:</span>';
        echo '<span class="cv-value">';
        echo $a['description'];
        echo '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="cv-section">';
        echo '<div class="cv-section-heading">Certifications</div>';
        echo '<div class="cv-section-content">';
        echo '<div class="cv-item">';
        echo '<span class="cv-value">';
        echo $a['certifications'];
        echo '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="cv-reviews">';
        echo '<div class="cv-section-heading">Reviews</div>';
        $reviews = $ConnectingDB->query("SELECT * FROM reviews WHERE artisan_id = " . $artisanId);
        if ($reviews->rowCount() > 0) {
          while ($r = $reviews->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="review">' . $r['review_text'] . '</div>';
          }
        } else {
          echo '<div>No reviews available</div>';
        }

        echo '</div>';
        echo "<div class='flex flex-column align-items-center justify-content-around'>";
        echo '<form action="services.php" method="post">';
        echo '<input type="hidden" name="service_id" value=' . $_POST["service_id"] . '>';
        echo '<input type="hidden" name="subservice_id" value=' . $_POST["subservice_id"] . '>';
        echo '<input type="submit" value="Back" class="btn">';
        echo '</form>';
        echo '<form method="post" action="devis.php">';
        echo '<input type="hidden" name="service_id" value=' . $_POST["service_id"] . '>';
        echo '<input type="hidden" name="subservice_id" value=' . $_POST["subservice_id"] . '>';
        echo '<input type="hidden" name="artisan_id" value=' . $_POST["artisan_id"] . '>';
        echo '<input type="hidden" name="artisan_full_name" value=' . $a["full_name"] . '>';
        echo '<input type="submit" value="Choose" class="btn">';
        echo '</form>';
        echo "</div>";
        echo '</div>';


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