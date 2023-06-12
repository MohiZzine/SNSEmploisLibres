<?php
session_start();

require_once('../../classes/database.class.php');
require_once('../../classes/user.class.php');

$old_password = $new_password = $repeat_new_password = "";
$old_password_err = $new_password_err = $repeat_new_password_err = "";
if (isset($_POST['change_password'])) {
  if (empty(trim($_POST['old_password']))) {
    $old_password_err = "Old password should not be empty!";
    header('Location: ../../views/change_password.php?error=' . $old_password_err);
    exit();
  } else {
    $old_password = trim(htmlspecialchars(strip_tags($_POST['old_password'])));
  }

  if (empty(trim($_POST['new_password']))) {
    $new_password_err = "New password should not be empty!";
    header('Location: ../../views/change_password.php?error=' . $new_password_err);
    exit();
  } else {
    $new_password = trim(htmlspecialchars(strip_tags($_POST['new_password'])));
  }
  
  if (!trim($_POST['repeat_new_password']) == trim($_POST['new_password'])) {
    $repeat_new_password_err = "New password does not match!";
    header('Location: ../../views/change_password.php?error=' . $repeat_new_password_err);
    exit();
  }

  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);
  $reset = $user->change_password($new_password, $_SESSION['user_id'], $old_password);
  
  if (!$reset['reset']) {
    header('location: ../../views/change_password.php?error=' . $reset['message']);
    exit;
  } 


  if ($reset['reset']) {
    $_SESSION['password'] = $user->get_phone_number();
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