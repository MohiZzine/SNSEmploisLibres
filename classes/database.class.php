<?php

include_once '../utils/config.php';

class Database
{
  private $host = SERVER_NAME;
  private $db = DB_NAME;
  private $username = USERNAME;
  private $password = PASSWORD;
  public $pdo;

  public function getConnection()
  {
    $this->pdo = null;
    try {
      $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $exception) {
      echo "Connection error:" . $exception->getMessage();
    }
  }
}
