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
    <link rel="stylesheet" href="../styles/modalServices.css" />
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
                $service = $_POST["service_id"];
                $q = "SELECT * 
                      FROM subservices WHERE service_id = '$service'";
                $stmt = $ConnectingDB->prepare($q);
                $stmt->execute();
                while ($s = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <div class="card">

                        <button name="subservice" class="btn subservice">
                            <?php echo "<h4>" . $s['subservice_name'] . '</h4></br>' . $s['subservice_description']; ?>
                        </button>

                        <!-- The Modal -->
                        <div class="modal">
                            <div class="modal-content">
                                <span class="close"
                                    style="color:black; position:absolute; right: 11px; top:0;">&times;</span>

                                <form method="post" action="subservices.php">
                                    <input type="hidden" name="service_id" value="<?php echo $s["service_id"]; ?>">
                                    <input type="hidden" name="subservice_id" value="<?php echo $s["subservice_id"]; ?>">
                                    <input type="hidden" name="subservice_name"
                                        value="<?php echo $s["subservice_name"]; ?>">
                                    <input type="hidden" name="subservice_description"
                                        value="<?php echo $s["subservice_description"]; ?>">
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
        const modals = document.querySelectorAll(".modal");
        const subservices_buttons = document.querySelectorAll(".subservice");
        for (let i = 0; i < subservices_buttons.length; i++) {
            subservices_buttons[i].onclick = function () {
                modals[i].style.display = "block";
            }
        }
        const spans = document.querySelectorAll(".close");
        for (let i = 0; i < spans.length; i++) {
            spans[i].onclick = function () {
                modals[i].style.display = "none";
            }
        }
        console.log(subservices_buttons[0])
        console.log(modals[0]);
        console.log(spans[0]);
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>

    <?php include '../includes/footer.php'; ?>