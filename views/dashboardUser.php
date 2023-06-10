<?php
session_start();
// var_dump($_SESSION);
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
  <link rel="stylesheet" href="../styles/modal.css" />
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
          <div class="card">
            <button id="service" name="service" class="btn">
              <?php echo "<h4>" . $s['service_name'] . '</h4></br>' . $s['service_description']; ?>
            </button>

            <!-- The Modal -->
            <div id="myModal" class="modal">
              <div class="modal-content">
                <span class="close" style="color:white; position:absolute; right: 11px; top:0;">&times;</span>

                <form method="post" action="../views/services.php">
                  <input type="hidden" name="service_id" value="<?php echo $s["service_id"]; ?>">
                  <label>Enter your city</label><br>
                  <input type="text" id="location" name="location" placeholder="City" required><br>
                  <input type="submit" name="submit" class="btn"></input>
                </form>

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
  <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("service");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function () {
      modal.style.display = "block";
    }
    span.onclick = function () {
      modal.style.display = "none";
    }
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

  <?php include '../includes/footer.php'; ?>