<?php
session_start();

require_once('../../classes/database.class.php');
require_once('../../classes/user.class.php');

$old_phone_number = $new_phone_number = $repeat_new_phone_number = "";
$old_phone_number_err = $new_phone_number_err = $repeat_new_phone_number_err = "";
if (isset($_POST['change_phone_number'])) {
  if (empty(trim($_POST['old_phone_number']))) {
    $old_phone_number_err = "Old phone_number should not be empty!";
    header('Location: ../../views/change_phone_number.php?error=' . $old_phone_number_err);
    exit();
  } else {
    $old_phone_number = trim(htmlspecialchars(strip_tags($_POST['old_phone_number'])));
  }

  if (empty(trim($_POST['new_phone_number']))) {
    $new_phone_number_err = "New phone_number should not be empty!";
    header('Location: ../../views/change_phone_number.php?error=' . $new_phone_number_err);
    exit();
  } else {
    $new_phone_number = trim(htmlspecialchars(strip_tags($_POST['new_phone_number'])));
  }
  
  if (!trim($_POST['repeat_new_phone_number']) == trim($_POST['new_phone_number'])) {
    $repeat_new_phone_number_err = "New phone_number does not match!";
    header('Location: ../../views/change_phone_number.php?error=' . $repeat_new_phone_number_err);
    exit();
  }

  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);
  $reset = $user->change_phone_number($new_phone_number, $_SESSION['user_id'], $old_phone_number);
  
  if (!$reset['reset']) {
    header('location: ../../views/change_phone_number.php?error=' . $reset['message']);
    exit;
  } 


  if ($reset['reset']) {
    $_SESSION['phone_number'] = $user->get_phone_number();
    if ($_SESSION['user_role'] == "user") {
      header('Location: ../../views/dashboardUser.php?success=' . $reset['message']);
      exit();
    }
    if ($_SESSION['user_role'] == "artisan") {
      header('location: ../../views/dashboardArtisan.php?success=' . $reset['message']);
      exit();
    }
  }
}