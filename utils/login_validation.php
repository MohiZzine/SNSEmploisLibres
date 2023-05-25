<?php

function is_email($input)
{
  // Checks if the input has the format of an email
  return filter_var($input, FILTER_VALIDATE_EMAIL);
}



function valid_username_or_email($username_or_email)
{
  if (is_email($username_or_email)) {
    return true;
  } else {
    return preg_match('/^[a-zA-Z0-9]{4,}$/u', $username_or_email);
  }
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
