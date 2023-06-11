<?php
session_start();

if (isset($_POST['change_username'])) {
  header('location: ../views/change_username.php');
  exit;
}

if (isset($_POST['change_password'])) {
  header('location: ../views/change_password.php');
  exit;
}

if (isset($_POST['change_email'])) {
  header('location: ../views/change_email.php');
  exit;
}

if (isset($_POST['change_phone_number'])) {
  header('location: ../views/change_phone_number.php');
  exit;
}

if (isset($_POST['logout'])) {
  session_destroy();
  header('location: ../index.php');
  exit;
}