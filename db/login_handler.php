<?php

include_once '../utils/login_validation.php';
include_once '../classes/database.class.php';
include_once '../classes/user.class.php';

$username_or_email = $username_or_email = "";
$password = $password_err = "";

if (isset($_POST['login'])) {
  $errors = array();

  // Validate username / email
  if (!valid_username_or_email(trim($_POST['username_or_email']))) {
    $username_or_email_err = "Username or Email should not be empty!";
    $errors['username_or_email'] = 'username_or_email=' . $username_or_email_err;
  } else {
    $username_or_email = trim(htmlspecialchars(strip_tags($_POST['username_or_email'])));
  }

  // Validate password
  if (!valid_password($_POST['password'])) {
    $password_err = "Password should not be empty!";
    $errors['password'] = 'password=' . $password_err;
  } else {
    $password = trim(htmlspecialchars(strip_tags($_POST['password'])));
  }

  if (!empty($errors)) {
    $errors = implode('&', $errors);
    header('Location: ../index.php?' . $errors);
  }

  $db = new Database();
  $db->getConnection();

  $user = new User($db->pdo);
  $login = $user->login($username_or_email, $password);
  if (!$login['login']) {
    header('Location: ../index.php?error=' . $error);
    exit();
  }


  session_start();
  var_dump($login);
  $_SESSION['user_id'] = $login['user_id'];
  $_SESSION['username'] = $user->get_username();
  $_SESSION['full_name'] = $user->get_full_name();
  $_SESSION['user_role'] = $user->get_role();
  if ($_SESSION['user_role'] == "user") {
    header('Location: ../views/dashboardUser.php');
    exit();
  }
  if ($_SESSION['user_role'] == "artisan") {
    header('location: ../views/dashboardArtisan.php');
    exit();
  }
}