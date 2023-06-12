<?php
session_start();

require_once('../../classes/database.class.php');
require_once('../../classes/user.class.php');

$old_username = $new_username = $repeat_new_username = "";
$old_username_err = $new_username_err = $repeat_new_username_err = "";
if (isset($_POST['change_username'])) {
  if (empty(trim($_POST['old_username']))) {
    $old_username_err = "Old username should not be empty!";
    header('Location: ../../views/change_username.php?error=' . $old_username_err);
    exit();
  } else {
    $old_username = trim(htmlspecialchars(strip_tags($_POST['old_username'])));
  }

  if (empty(trim($_POST['new_username']))) {
    $new_username_err = "New username should not be empty!";
    header('Location: ../../views/change_username.php?error=' . $new_username_err);
    exit();
  } else {
    $new_username = trim(htmlspecialchars(strip_tags($_POST['new_username'])));
  }
  
  if (!trim($_POST['repeat_new_username']) == trim($_POST['new_username'])) {
    $repeat_new_username_err = "New username does not match!";
    header('Location: ../../views/change_username.php?error=' . $repeat_new_username_err);
    exit();
  }
  
  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);
  $reset = $user->change_username($new_username, $_SESSION['user_id'], $old_username);

  if (!$reset['reset']) {
    header('location: ../../views/change_username.php?error=' . $reset['message']);
    exit;
  } 


  if ($reset['reset']) {
    $_SESSION['username'] = $user->get_username();
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