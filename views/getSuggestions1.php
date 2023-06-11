<?php

session_start();
require_once("../utils/database.php");






    $ConnectingDB = $GLOBALS['pdo'];
    $rating = $_GET['rating'] ?? '';

    //$service = $_POST['service_id'] ;
    //$subservice = $_POST['subservice_id'] ;
    //$subservice_name = $_POST['subservice_name'] ;
    //$subservice_description = $_POST['subservice_description'] ;


    //$artisan = $_POST['artisan_id'] ;
    //$location = $_POST['location'] ;


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
 


    /*$sql = $ConnectingDB->query("SELECT * FROM artisan_services WHERE price=:price ");
    
    $sql->bindParam(':price', $price, PDO::PARAM_STR);
    $sql->execute();*/
    /*while ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $artisan_id = $a['artisan_id'];
        $sql1 = "SELECT * FROM artisans WHERE artisan_id = :artisan_id";
        $stmt1 = $ConnectingDB->prepare($sql1);
        $stmt1->bindParam(':artisan_id', $artisan_id, PDO::PARAM_STR);
        $stmt1->execute();
        /*$sql1 = $ConnectingDB->query("SELECT * FROM artisans WHERE artisan_id = :artisan_id");
        $sql1->bindParam(':artisan_id', $artisan_id, PDO::PARAM_STR);
        $sql1->execute();
        while ($s = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $s['user_id'];
            $sql2 = "SELECT * FROM users WHERE user_id = :user_id";
            $stmt2 = $ConnectingDB->prepare($sql2);
            $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt2->execute();
            /*$sql2 = $ConnectingDB->query("SELECT * FROM users WHERE user_id = :user_id");
            $sql2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $sql2->execute();
            while ($u = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                echo '<p>artisan_name: ', $u['full_name'].'</p>';
                
            }


        }

       



    }*/

    

    
  
    //echo json_encode($results);
    //echo json_encode($results1);


?>