<?php

// This utility function checks if the password contains at least one uppercase letter, one lowercase letter and one number, and is at least 6 characters long
function valid_password($password)
{
  return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $password);
}
