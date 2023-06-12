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

if (isset($_POST['yes'])) {
  $ConnectingDB = $GLOBALS['pdo'];
  $reviews = "INSERT INTO reviews(user_id, artisan_id, rating) VALUES('$_SESSION[user_id], '$_POST[artisan_id]', )";
  $review = $ConnectingDB->prepare($reviews);
  $review->execute();
  
  if ($review) {
    echo "<script>alert('Thank you for your review!')</script>";
  }
}

require_once "../utils/database.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reviews</title>
  <link rel="stylesheet" href="../styles/dashboard.css" />
  <link rel="stylesheet" href="../styles/cards.css" />
  <link rel="stylesheet" href="../styles/notifications.css" />
  <link rel="stylesheet" href="../styles/reviews.css" />
  <link rel="stylesheet" href="../styles/modalServices.css" />
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
        $reviews = $ConnectingDB->query("SELECT * 
        FROM artisans 
        WHERE artisan_id IN (SELECT DISTINCT artisan_id
                             FROM requests
                             WHERE user_id = '$_SESSION[user_id]')");
        while ($artisan = $reviews->fetch(PDO::FETCH_ASSOC)) {
          $artisans_reviews = $ConnectingDB->query("SELECT * FROM users WHERE user_id = '$artisan[user_id]'");
          $r = $artisans_reviews->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="card m-3 mx-2" style="">
            <?php echo "<h1>" . $r['full_name'] . "</h1></br>" . "<p style='color: black'><b>Company: </b>" . $artisan['company_name'] . '</p>'; ?>
            <div class="rate">
              <input type="radio" id="star5" name="rate" class="rate" value="5" />
              <label for="star5" title="text">5 stars</label>
              <input type="radio" id="star4" name="rate" class="rate" value="4" />
              <label for="star4" title="text">4 stars</label>
              <input type="radio" id="star3" name="rate" class="rate" value="3" />
              <label for="star3" title="text">3 stars</label>
              <input type="radio" id="star2" name="rate" class="rate" value="2" />
              <label for="star2" title="text">2 stars</label>
              <input type="radio" id="star1" name="rate" class="rate" value="1" />
              <label for="star1" title="text">1 star</label>
            </div>
            <!-- The Modal -->
            <div class="modal">
              <div class="modal-content">
                <span class="close" style="color:black; position:absolute; right: 11px; top:0;">&times;</span>

                <form method="post" action="">
                  <input type="hidden" name="artisan_id" value="<?php echo $artisan["artisan_id"]; ?>">
                  <label>Do you want to confirm?</label><br>
                  <button type="submit" name="yes" class="btn">Yes</button>
                </form>

              </div>
            </div>

          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <script>
    const modals = document.querySelectorAll(".modal");
    const rating_buttons = document.querySelectorAll(".rate");
    for (let i = 0; i < rating_buttons.length; i++) {
      rating_buttons[i].onclick = function () {
        modals[i].style.display = "block";
      }
    }
    const spans = document.querySelectorAll(".close");
    for (let i = 0; i < spans.length; i++) {
      spans[i].onclick = function () {
        modals[i].style.display = "none";
      }
    }
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <?php include '../includes/footer.php'; ?>