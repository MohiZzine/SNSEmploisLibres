<?php
session_start();
require_once("../utils/database.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subservices</title>
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <link rel="stylesheet" href="../styles/cards.css" />
    <script>
        var typingTimer;
        var doneTypingInterval = 500; // Adjust the delay as needed

        function showHint() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(fetchSuggestions, doneTypingInterval);
        }
        function fetchSuggestions() {
          var price = document.getElementsByName("price")[0].value;
          var serviceId = document.getElementsByName("service_id")[0].value;
          var subserviceId = document.getElementsByName("subservice_id")[0].value;
          var location = document.getElementsByName("location")[0].value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("card").innerHTML = this.responseText;
              }
          };
          xhttp.open("GET", "getSuggestions.php?price=" + price + "&service_id=" + encodeURIComponent(serviceId) + "&subservice_id=" + encodeURIComponent(subserviceId) + "&location=" + encodeURIComponent(location), true);
          xhttp.send()
      }
      


    </script>
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
                if (isset($_POST['submit'])) {
                    $ConnectingDB = $GLOBALS['pdo'];
                    $service = $_POST["service_id"];
                    $subservice = $_POST["subservice_id"];
                    $location = $_POST["location"];
                    $q = "SELECT * 
                            FROM Users U Natural JOIN (SELECT *
                                                        FROM artisan_services NATURAL JOIN Artisans 
                                                        WHERE subservice_id='$subservice' AND location='$location') P";
                    $stmt = $ConnectingDB->prepare($q);
                    $stmt->execute();
                    if ($stmt->rowCount() != 0) {
                        echo '<h3><b>Enter a price:</b> </h3>';
                        echo '<p> Suggestions: <span id="txtHint"></span></p>';
                        $serviceId = $_POST['service_id'];
                        $subserviceId = $_POST['subservice_id'];
                        $location = $_POST['location'];?>
                        <form method="GET" action="">;
                        <input type="number" name="price" oninput="showHint()" >;
                        <input type="hidden" name="service_id" value="<?php echo $serviceId; ?>">
                        <input type="hidden" name="subservice_id" value="<?php echo $subserviceId; ?>">
                        <input type="hidden" name="location" value="<?php echo $location; ?>">

                        </form>;
                    

                        


                        <?php while ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                            <div class="card" id ="card">

                                <?php
                                if ($a["profile_picture"]) {
                                    echo '<img src="' . $a['profile_picture'] . '" alt="artisan">';
                                } else {
                                    echo '<img src="../assets/user.jpg" alt="artisan">';
                                } ?>

                                <h3>
                                    <?php echo $a["full_name"]; ?>
                                </h3>
                                <h3><b>Company:</b>
                                    <?php echo $a["company_name"]; ?>
                                </h3>
                                <form method="post" action="profile.php">
                                    <input type="hidden" name="artisan_id" value="<?php echo $a["artisan_id"]; ?>">
                                    <input type="hidden" name="service_id" value="<?php echo $_POST["service_id"]; ?>">
                                    <input type="hidden" name="subservice_id" value="<?php echo $_POST["subservice_id"]; ?>">
                                    <input type="hidden" name="subservice_name" value="<?php echo $_POST["subservice_name"]; ?>">
                                    <input type="hidden" name="subservice_description"
                                        value="<?php echo $_POST["subservice_description"]; ?>">
                                    <button type="submit" id="artisan" name="artisan" class="btn">View Profile
                                    </button>
                                </form>
                            </div>


                        <?php }
                    } else {
                        echo "<p>There are no craftsmen of this service in your area.</p>";
                    }
                } ?>
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