<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require_once("../utils/database.php");

$ConnectingDB = $GLOBALS['pdo'];

// If the user confirms the request
if (isset($_POST['submit'])) {

    if (!empty($_POST["reservation_date"]) && !empty($_POST["reservation_time"])) {

        $user_id = $_SESSION["user_id"];
        echo $_POST["subservice_id"];
        echo $_POST["artisan_id"];
        $subservice_id = $_POST["subservice_id"];
        $artisan_id = $_POST["artisan_id"];
        $date_requested = $_POST["reservation_date"] . " " . $_POST["reservation_time"];
        $request = "INSERT INTO requests(user_id, subservice_id, artisan_id, reservation_date) VALUES ('$user_id', '$subservice_id', '$artisan_id', STR_TO_DATE('$date_requested', '%m/%d/%Y %H:%i:%s'))";
        $stmt = $ConnectingDB->prepare($request);
        $stmt->execute();

        if ($stmt) {
            echo "<script>alert('Request sent!')</script>";
        }

    } else {
        echo "<script>alert('All fields are required!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <title>SNS Emplois Libres</title>
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <link rel="stylesheet" href="../styles/cards.css" />
    <link rel="stylesheet" href="../styles/modalDevis.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include '../includes/dashboard_header.php'; ?>
        <div class="container-fluid">
            <p>Request sent!</p>
        </div>
    </div>

    <script src="../assets/js/devis.js"></script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>

    <?php include '../includes/footer.php'; ?>