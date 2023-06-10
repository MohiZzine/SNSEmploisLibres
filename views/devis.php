<?php session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
  exit();
}

include_once '../classes/database.class.php';

?>

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
              $service = $ConnectingDB->query("SELECT * FROM services");
              while ($s = $service->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="card">
                  <form method="post" action="views/services.php">
                    <input type="hidden" name="service_id" value="<?php echo $s["service_id"]; ?>">
                    <button type="submit" id="service" name="service" class="btn">
                      <?php echo "<h4>". $s['service_name'].'</h4></br>'. $s['service_description']; ?>
                    </button>
                  </form>
                </div>

              <?php } ?>
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

  <?php include 'views/footer.php'; ?>