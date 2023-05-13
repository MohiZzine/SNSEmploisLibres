<?php

include_once '../utils/validation.php';

$username = $name = $email = $password = $role = "";
$username_err = $name_err = $email_err = $password_err = $role_err = "";
$errors = array();

if (isset($_GET['login'])) {
  if (empty(trim($_GET['username']))) {
    $username_err = "Username should not be empty!";
    $errors['username'] = 'username=' . $username_err;
  } else {
    $username = trim(htmlspecialchars(strip_tags($_GET['username'])));
  }

  if (empty(trim($_GET['name']))) {
    $name_err = "Name should not be empty!";
    $errors['name'] = 'name=' . $name_err;
  } else {
    $name = trim(htmlspecialchars(strip_tags($_GET['name'])));
  }

  if (empty(trim($_GET['email']))) {
    $email_err = "Email should not be empty!";
    $errors['email'] = 'email=' . $email_err;
  } else {
    $email = trim(htmlspecialchars(strip_tags($_GET['email'])));
  }

  if (!valid_password($_GET['password'])) {
    $password_err = "Password should not be empty!";
    $errors['password'] = 'password=' . $password_err;
  } else {
    $password = trim(htmlspecialchars(strip_tags($_GET['password'])));
  }

  if (empty(trim($_GET['role']))) {
    $role_err = "Role should not be empty!";
    $errors['role'] = 'role=' . $role_err;
  } else {
    $role = trim(htmlspecialchars(strip_tags($_GET['role'])));
  }

  if (!empty($errors)) {
    $errors_string = implode('&', $errors);

    header('Location: ../views/login.php?' . $errors_string);
  }

  include '../utils/database.php';

  $user = new User($conn);
  $login = $user->login($username, $password);
  if (!$login) {
    $login_error = "User not found! Enter a correct username!";
    header('Location: ../views/login.php?error=' . $login_error);
    exit();
  }

  if ($login == "Password is incorrect!") {
    header('Location: ../views/login.php?error=' . $login);
    exit();
  }

  session_start();
  $_SESSION['user_id'] = $login['user_id'];
  $_SESSION['username'] = $login['username'];
  header('Location: ../index.php');
  exit();
}
