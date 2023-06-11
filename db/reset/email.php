<?php
session_start();

require_once('../../classes/database.class.php');
require_once('../../classes/user.class.php');

$old_email = $new_email = $repeat_new_email = "";
$old_email_err = $new_email_err = $repeat_new_email_err = "";
if (isset($_POST['change_email'])) {
  if (empty(trim($_POST['old_email']))) {
    $old_email_err = "Old email should not be empty!";
    header('Location: ../../views/change_email.php?error=' . $old_email_err);
    exit();
  } else {
    $old_email = trim(htmlspecialchars(strip_tags($_POST['old_email'])));
  }

  if (empty(trim($_POST['new_email']))) {
    $new_email_err = "New email should not be empty!";
    header('Location: ../../views/change_email.php?error=' . $new_email_err);
    exit();
  } else {
    $new_email = trim(htmlspecialchars(strip_tags($_POST['new_email'])));
  }
  
  if (!trim($_POST['repeat_new_email']) == trim($_POST['new_email'])) {
    $repeat_new_email_err = "New email does not match!";
    header('Location: ../../views/change_email.php?error=' . $repeat_new_email_err);
    exit();
  }

  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);
  $reset = $user->change_email($new_email, $_SESSION['user_id'], $old_email);
  
  if (!$reset['reset']) {
    header('location: ../../views/change_email.php?error=' . $reset['message']);
    exit;
  } 


  if ($reset['reset']) {
    $_SESSION['email'] = $user->get_email();
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