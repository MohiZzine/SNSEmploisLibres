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
    $username = trim(htmlspecialchars(strip_tags($_POST['username_or_email'])));
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
    header('Location: ../views/login.php?' . $errors);
  }

  $db = new Database();
  $db->getConnection();

  $user = new User($db->pdo);
  $login = $user->login($username_or_email, $password);
  if (!$login['login']) {
    if ($login['message'] == "Username or Email is incorrect!") {
      $error = $login['message'];
      header('Location: ../views/login.php?error=' . $error);
      exit();
    } else if ($login['message'] == "Password is incorrect!") {
      $error = $login['message'];
      header('Location: ../views/login.php?error=' . $error);
      exit();
    }
  }


  session_start();
  $_SESSION['user_id'] = $login['user_id'];
  $_SESSION['username'] = $user->get_username();
  $_SESSION['full_name'] = $user->get_full_name();
  header('Location: ../index.php');
  exit();
}
