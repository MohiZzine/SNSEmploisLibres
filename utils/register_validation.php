<?php


// These utility function are used to validate user input in the register and login forms.
// The functions are called in the register_handler.php and login_handler.php files.

function valid_username($username)
{
  // Checks if the username contains:
  // - Only letters and numbers
  // - At least 4 characters
  $result = preg_match('/^[a-zA-Z0-9]{4,}$/u', $username);
  return $result;
}

function valid_full_name($name)
{
  // Checks if the full name contains:
  // - Only letters
  // - At least 2 characters

  $result = preg_match('/^[\p{L}\s]{2,}$/u', $name);
  return $result;
}

function valid_email($email)
{
  // Checks if the email is valid
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function valid_password($password)
{
  // Checks if the password contains:
  // - At least one uppercase letter
  // - One lowercase letter
  // - At least one number
  // - Is at least 6 characters long
  return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $password);
}

function valid_confirm_password($password, $confirm_password)
{
  // Checks if the password and confirm password fields match
  return $confirm_password === $password;
}

function valid_phone_number($phone_number)
{
  // Checks if the phone number:
  // - Is 10 digits long
  // - Starts with 07
  return preg_match('/^07[0-9]{8}$/', $phone_number);
}
