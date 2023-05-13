<?php


// These utility function are used to validate user input in the register and login forms.
// The functions are called in the register_handler.php and login_handler.php files.

function valid_username($username)
{
  // Checks if the username:
  // - Contains only letters and numbers
  // - Is at least 6 characters long
  return preg_match('/^[a-zA-Z0-9]{6,}$/', $username);
}

function valid_name($name)
{
  // Checks if the name: 
  // - Contains only letters 
  // - And is at least 2 characters long

  return preg_match('/^[a-zA-Z]{2,}$/', $name);
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

// function valid_role($role) {

// }

function valid_confirm_password($password, $confirm_password)
{
  // Checks if the password and confirm password fields match
  return $confirm_password === $password;
}
