<?php
session_start();
require_once("../utils/database.php");

    $ConnectingDB = $GLOBALS['pdo'];
    $rating = $_GET['rating'] ?? '';

    $service = $_GET['service_id'] ?? '';
    $subservice = $_GET['subservice_id'] ?? '';
    $location = $_GET['location'] ?? '';
    $ratings = "SELECT *
    FROM Users U
    NATURAL JOIN (
        SELECT *
        FROM artisan_services
        NATURAL JOIN Artisans
        NATURAL JOIN reviews
        WHERE subservice_id='$subservice' AND location='$location' AND rating = '$rating'
    ) P";                                       
    $stmt = $ConnectingDB->prepare($ratings);
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
                                    <input type="hidden" name="service_id" value="<?php echo $service; ?>">
                                    <input type="hidden" name="subservice_id" value="<?php echo $subservice; ?>">
                                    <button type="submit" id="artisan" name="artisan" class="btn">View Profile
                                    </button>
                </form>
            </div>

        <?php }
    } else {
        echo "<p>There are no craftsmen of this service in your area.</p>";
    }

?>