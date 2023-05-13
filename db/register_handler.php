<?php

require_once '../utils/validation.php';

$username = $name = $email = $password = $role = "";
$username_err = $name_err = $email_err = $password_err = $role_err = "";

if (isset($_POST['register'])) {
  $errors = array();

  // Validate username
  if (!valid_username(trim($_GET['username']))) {
    $username_err = "Username should not be empty!";
    $errors['username'] = 'username=' . $username_err;
  } else {
    $username = htmlspecialchars(strip_tags(trim($_GET['username'])));
  }

  // Validate name
  if (!valid_name(trim($_GET['name']))) {
    $name_err = "Name should not be empty!";
    $errors['name'] = 'name=' . $name_err;
  } else {
    $name = htmlspecialchars(strip_tags(trim($_GET['name'])));
  }

  // Validate name
  if (!valid_email(trim($_GET['email']))) {
    $email_err = "Email should not be empty!";
    $errors['email'] = 'email=' . $email_err;
  } else {
    $email = htmlspecialchars(strip_tags(trim($_GET['email'])));
  }

  // Validate password
  if (!valid_password(trim($_GET['password']))) {
    $password_err = "Password should not be empty!";
    $errors['password'] = 'password=' . $password_err;
  } else {
    $password = htmlspecialchars(strip_tags(trim($_GET['password'])));
  }

  // Validate role 
  if (empty(trim($_GET['role']))) {
    $role_err = "Role should not be empty!";
    $errors['role'] = 'role=' . $role_err;
  } else {
    $role = htmlspecialchars(strip_tags(trim($_GET['role'])));
  }

  // Validate confirm password
  if (!valid_confirm_password(trim($_GET['confirm_password']), trim($_GET['password']))) {
    $confirm_password_err = "Passwords do not match!";
    $errors['confirm_password'] = 'confirm_password=' . $confirm_password_err;
  } else {
    $confirm_password = htmlspecialchars(strip_tags(trim($_GET['confirm_password'])));
  }
}

if (!empty($errors)) {
  $errors_string = implode('&', $errors);
  header('Location: ../views/register.php?' . $errors_string);
  exit();
}

include '../utils/database.php';
$user = new User($conn);

$user->setAttributes($username, $name, $email, $password, $role);
$register = $user->register();

if (!$register) {
  $error = "Username not registered!";
  header('Location: ../views/register.php?error=' . $error);
  exit();
}

session_start();
$_SESSION['user_id'] = $register;
$_SESSION['username'] = $username;
$_SESSION['name'] = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role'] = $role;
header('Location: ../index.php');
exit();




// require_once '../utils/database.php';