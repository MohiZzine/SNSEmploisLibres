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

if (isset($_POST['yes'])) {
  $ConnectingDB = $GLOBALS['pdo'];
  $sql = "INSERT INTO reviews(user_id, artisan_id, rating, review_text) VALUES('$_SESSION[user_id]', '$_POST[artisan_id]', '$_POST[output]', '$_POST[review_text]')";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->execute();
  
  if ($stmt) {
    echo "<script>alert('Thank you for your review!')</script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again.')</script>";
  }
  
  $_POST['yes'] = null; 

}

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
                             WHERE user_id = '$_SESSION[user_id]')
                             AND artisan_id NOT IN (SELECT artisan_id FROM reviews WHERE reviews.user_id = '$_SESSION[user_id]')");
        while ($artisan = $reviews->fetch(PDO::FETCH_ASSOC)) {
          $artisans_reviews = $ConnectingDB->query("SELECT * FROM users WHERE user_id = '$artisan[user_id]'");
          $r = $artisans_reviews->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="card m-3 mx-2">

            <form method="post" action="">
              <?php echo "<h1>" . $r['full_name'] . "</h1></br>" . "<p style='color: black'><b>Company: </b>" . $artisan['company_name'] . '</p>'; ?>
              <div style="display: flex; flex-direction:column-reverse; align-items: center; justify-content: between; gap: 10px;">
                <div class="rate" >
                  <input type="radio" id="star5" name="rate" class="rate star" value="5" />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rate" class="rate star" value="4" />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rate" class="rate star" value="3" />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rate" class="rate star" value="2" />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rate" class="rate star" value="1" />
                  <label for="star1" title="text">1 star</label>
                  
                </div>
                <textarea name="review_text" id="comment" cols="55" rows="3" ></textarea>
                <br>
              </div>
            <!-- The Modal -->
            <div class="modal">
              <div class="modal-content">
                <span class="close" style="color:black; position:absolute; right: 11px; top:0;">&times;</span>
                
                  <input type="hidden" id="output" name="output">
                  <input type="hidden" name="artisan_id" value="<?php echo $artisan["artisan_id"]; ?>">
                  
                  <label>Do you want to confirm?</label><br>
                    <!-- <script>

                      const para = document.createElement("p");
                      const node = document.createTextNode("This is new.");
                      para.appendChild(node);

                      const element = document.getElementById("div1");
                      element.appendChild(para);
                    </script> -->
                  <button type="submit" name="yes" class="btn" value="">Yes</button>
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

    stars = document.querySelectorAll(".star");
    output = document.querySelector("#output");
    for (let i = 0; i < stars.length; i++) {
      stars[i].onclick = function () {
        output.value = stars[i].value;
        console.log(output);
        // console.log(output.value);
      }
    }
  </script>
  <?php include '../includes/footer.php'; ?>