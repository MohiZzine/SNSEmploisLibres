<?php
session_start();
require_once("../utils/database.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
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
                        while ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                            <div class="card">

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