<?php

// This file is uniquely for the connection to the database
// It is included in every file that needs to connect to the database

include_once 'config.php';

try {
  $conn = new PDO('mysql:host=' . SERVER_NAME . ';dbname=' . DB_NAME, USERNAME, PASSWORD);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Connection failed:' . $e->getMessage();
}
