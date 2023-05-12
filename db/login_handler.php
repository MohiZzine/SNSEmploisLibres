<?php

$username = $name = $email = $password = $role = "";
$username_err = $name_err = $email_err = $password_err = $role_err = "";
$errors = array();

if (isset($_GET['login'])) {
  if (empty(trim($_GET['username']))) {
    $username_err = "Username should not be empty!";
    $errors['username'] = 'username=' . $username_err;
  }

  if (empty(trim($_GET['name']))) {
    $name_err = "Name should not be empty!";
    $errors['name'] = 'name=' . $name_err;
  }

  if (empty(trim($_GET['email']))) {
    $email_err = "Email should not be empty!";
    $errors['email'] = 'email=' . $email_err;
  }

  if (empty(trim($_GET['password']))) {
    $password_err = "Password should not be empty!";
    $errors['password'] = 'password=' . $password_err;
  }
}
