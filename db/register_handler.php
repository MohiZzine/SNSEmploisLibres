<?php

require_once '../utils/register_validation.php';

$username = $full_name = $email = $password =  $confirm_password = $role = $phone_number = "";
$username_err = $full_name_err = $email_err = $password_err = $confirm_password_err = $role_err = $phone_number_err = "";

if (isset($_POST['register'])) {
  $errors = array();

  // Validate username
  if (!valid_username(trim($_POST['username']))) {
    $username_err = "Username must: <br> - Be at least 4 characters long <br> - Contain only letters and numbers";
    $errors['username'] = 'username=' . $username_err;
  } else {
    $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
  }

  // Validate name
  if (!valid_full_name(trim($_POST['full_name']))) {
    $full_name_err = "Full Name must: <br> - Be at least 4 characters long <br> - Contain only letters";
    $errors['full_name'] = 'full_name=' . $full_name_err;
  } else {
    $full_name = htmlspecialchars(strip_tags(trim($_POST['full_name'])));
  }


  // Validate name
  if (!valid_email(trim($_POST['email']))) {
    $email_err = "Email should be valid!";
    $errors['email'] = 'email=' . $email_err;
  } else {
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
  }

  // Validate password
  if (!valid_password(trim($_POST['password']))) {
    $password_err = "Password must: <br> - Be at least 6 characters long <br> - Contain at least 1 uppercase letter <br> - Contain at least 1 lowercase letter <br> - Contain at least 1 number <br> - Contain at least 1 special character";
    $errors['password'] = 'password=' . $password_err;
  } else {
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
  }

  // Validate role 
  if (empty(trim($_POST['role']))) {
    $role_err = "Choose your role!";
    $errors['role'] = 'role=' . $role_err;
  } else {
    $role = htmlspecialchars(strip_tags(trim($_POST['role'])));
  }

  // Validate confirm password
  if (!trim($_POST['confirm_password']) == trim($_POST['password'])) {
    $confirm_password_err = "Passwords do not match!";
    $errors['confirm_password'] = 'confirm_password=' . $confirm_password_err;
  } else {
    $confirm_password_err = htmlspecialchars(strip_tags(trim($_POST['confirm_password'])));
  }
  
  // Validate phone number
  if (!valid_phone_number(trim($_POST['phone_number']))) {
    $phone_number_err = "Phone number should: <br> - Be 10 digits long <br> - Start with 07";
    $errors['phone_number'] = 'phone_number=' . $phone_number_err;
  } else {
    $phone_number = htmlspecialchars(strip_tags(trim($_POST['phone_number'])));
  }


  if (!empty($errors)) {
    $errors_string = implode('&', $errors);
    header('Location: ../views/register.php?' . $errors_string);
    exit();
  }

  // include '../utils/database.php';
  include_once '../classes/database.class.php';
  include_once '../classes/user.class.php';

  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);

  $user->setAttributes($username, $full_name, $email, $password, $phone_number, $role);
  $register = $user->register();

  if (!$register) {
    $error = "Username not registered!";
    header('Location: ../views/register.php?error=' . $error);
    exit();
  }

  session_start();
  $_SESSION['user_id'] = $register;
  $_SESSION['username'] = $username;
  $_SESSION['full_name'] = $full_name;
  $_SESSION['user_email'] = $email;
  $_SESSION['user_role'] = $role;
  if ($_SESSION['user_role'] == "user") {
    header('Location: ../views/dashboardUser.php');
    exit();
  }
  if ($_SESSION['user_role'] == "artisan") {
    header('location: ../views/dashboardArtisan.php');
    exit();
  }
}  




// require_once '../utils/database.php';