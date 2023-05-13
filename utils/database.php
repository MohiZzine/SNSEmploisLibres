<!-- <?php

      // This file is uniquely for the connection to the database
      // It is included in every file that needs to connect to the database

      include_once 'config.php';

      try {
        $pdo = new PDO('mysql:host=' . SERVER_NAME . ';dbname=' . DB_NAME, USERNAME, PASSWORD);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo 'Connection failed:' . $e->getMessage();
      }
      ?> -->