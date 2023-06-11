<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: ../index.php');
    exit();
}
require_once("../utils/database.php");

$ConnectingDB = $GLOBALS['pdo'];

// If the request is accepted
if (isset($_POST['accept_request'])) {

    $request_id = $_POST["request_id"];
    $user_id = $_POST["user_id"];

    // Change thhe status of the request to 'accepted'
    $accept = "UPDATE requests SET status='accepted' WHERE request_id='$request_id'";
    $stmt = $ConnectingDB->prepare($accept);
    $stmt->execute();

    // Send a notification to the user
    $notification = "INSERT INTO notifications(user_id, request_id, message) VALUES ('$user_id', '$request_id', 'Your request has been accepted')";
    $stmt2 = $ConnectingDB->prepare($notification);
    $stmt2->execute();


    if ($stmt && $stmt2) {
        echo "<script>alert('Request Accepted!')</script>";
    }
}

// If the request is declined
if (isset($_POST['decline_request'])) {

    $request_id = $_POST["request_id"];
    $user_id = $_POST["user_id"];

    // Change the status of the request to 'declined'
    $accept = "UPDATE requests SET status='declined' WHERE request_id='$request_id'";
    $stmt = $ConnectingDB->prepare($accept);
    $stmt->execute();

    // Send a notification to the user
    $notification = "INSERT INTO notifications(user_id, request_id, message) VALUES ('$user_id','$request_id', 'Your request has been declined')";
    $stmt2 = $ConnectingDB->prepare($notification);
    $stmt2->execute();


    if ($stmt && $stmt2) {
        echo "<script>alert('Request declined!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SNS Emplois Libres</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <div class="vertical-container">
                <?php
                $ConnectingDB = $GLOBALS['pdo'];
                $artisan = $_SESSION['user_id'];
                $pd = "SELECT * FROM requests NATURAL JOIN users WHERE artisan_id='$artisan' AND status='pending'";
                $stmt = $ConnectingDB->prepare($pd);
                $stmt->execute();
                if ($stmt->rowCount() != 0) {
                    echo "<table class='artisan-table'><tr><th>Request</th><th>Action</th></tr>";
                    while ($pending_request = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $subservice = $ConnectingDB->query("SELECT * FROM subservices NATURAL JOIN services WHERE subservice_id=" . $pending_request['subservice_id']);
                        $subservice_info = $subservice->fetch(PDO::FETCH_ASSOC);
                        $costQuery = $ConnectingDB->query("SELECT price FROM artisan_services WHERE subservice_id=" . $pending_request['subservice_id'] . " AND artisan_id=" . $artisan);
                        $cost = $costQuery->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                            <td>
                                <?php echo "<p><b>Request from: </b>" . $pending_request['full_name'] . '</p>
                            <p><b>Service: </b>' . $subservice_info['service_name'] . '</p>
                            <p><b>Subservice: </b>' . $subservice_info['subservice_name'] . '</p>
                            <p><b>Price: </b>' . $cost['price'] . ' MAD</p><p><b>Phone number: </b>' . $pending_request['phone_number'] . '</p>'; ?>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="request_id"
                                        value="<?php echo $pending_request["request_id"]; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $pending_request["user_id"]; ?>">
                                    <div style="display:inline;">
                                        <button type="submit" class="decline_btn btn" name="decline_request">
                                            <i class="delete-icon material-icons">delete</i>
                                        </button>
                                        <button type="submit" class="accept_btn btn" name="accept_request">
                                            <i class="delete-icon material-icons">check</i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </div>
                <?php }
                } else {
                    echo "<p>You don't have any requests.</p>";
                } ?>

            </table>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <?php include '../includes/footer.php'; ?>