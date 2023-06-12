<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require_once("../utils/database.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>SNS Emplois Libres</title>
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <link rel="stylesheet" href="../styles/modalDevis.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php include '../includes/dashboard_header.php'; ?>
        <div class="container-fluid" style="color: black;">
            <?php
            $ConnectingDB = $GLOBALS['pdo'];
            // If the user confirms the request
            if (isset($_POST['submit'])) {
            
                if (!empty($_POST["reservation_date"]) && !empty($_POST["reservation_time"])) {
            
                    $user_id = $_SESSION["user_id"];
                    $subservice_id = $_SESSION["subservice_id"];
                    $artisan_id = $_SESSION["artisan_id"];
                    $date_requested = $_POST["reservation_date"] . " " . $_POST["reservation_time"];
                    $request = "INSERT INTO requests(user_id, subservice_id, artisan_id, reservation_date) VALUES ('$user_id', '$subservice_id', '$artisan_id', STR_TO_DATE('$date_requested', '%m/%d/%Y %H:%i:%s'))";
                    $stmt = $ConnectingDB->prepare($request);
                    $stmt->execute();
            
                    if ($stmt) {
                        echo "<p>Request sent!</p>";
                    }
            
                } else {
                    echo "<script>alert('All fields are required!')</script>";
                }
            }
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>