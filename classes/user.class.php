<?php

require_once 'database.class.php';

class User
{
  private $user_id;
  private $username;
  private $full_name;
  private $email;
  private $password;
  private $role;
  private $phone_number;
  private $pdo;

  // Now I need to add a constructor to the class to initialize the database connection
  // Knowing I created a file in the utils folder called database.php where I have the connection to the database
  public function __construct($db)
  {
    $this->pdo = $db;
  }

  public function setAttributes($username, $full_name, $email, $password, $phone_number, $role)
  {
    $this->username = $username;
    $this->full_name = $full_name;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
    $this->phone_number = $phone_number;
  }

  public function get_user_id()
  {
    return $this->user_id;
  }

  public function get_username()
  {
    return $this->username;
  }

  public function get_full_name()
  {
    return $this->full_name;
  }

  public function get_email()
  {
    return $this->email;
  }

  public function get_password()
  {
    return $this->password;
  }

  public function get_role()
  {
    return $this->role;
  }

  public function get_phone_number()
  {
    return $this->phone_number;
  }



  private function set_username($new_username)
  {
    $this->username = $new_username;
  }

  private function set_email($new_email)
  {
    $this->email = $new_email;
  }

  private function set_password($new_password)
  {
    $this->password = $new_password;
  }

  private function set_role($role)
  {
    $this->role = $role;
  }

  private function set_phone_number($tel)
  {
    $this->phone_number = $tel;
  }

  public function register()
  {
    $sql = "INSERT INTO users (username, full_name, email, password, phone_number, role) VALUES(:username, :full_name, :email, :password, :phone_number, :role)";
    $stmt = $this->pdo->prepare($sql);

    $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

    if ($stmt->execute(['username' => $this->username, 'full_name' => $this->full_name, 'email' => $this->email, 'password' => $hashed_password, 'phone_number' => $this->phone_number, 'role' => $this->role])) {
      // Get user_id from the database

      return $this->pdo->lastInsertId();
    }
    return false;
  }

  public function login($username_or_email, $password)
  {
    $sql = "SELECT * FROM users WHERE (username =:username) OR (email =:email)";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(['username' => $username_or_email, 'email' => $username_or_email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      if (password_verify($password, $result['password'])) {
        ['full_name' => $full_name, 'username' => $username, 'email' => $email, 'password' => $password, 'phone_number' => $phone_number, 'role' => $role] = $result;
        $this->setAttributes($username, $full_name, $email, $password, $phone_number, $role);
        return ['login' => true, 'message' => 'Login successful!', 'user_id' => $result['user_id']];
      }
      return ['login' => false, 'message' => 'Password is incorrect'];
    }
    return ['login' => false, 'message' => "Username or email is incorrect!"];
  }

  public function reset_password($new_password)
  {
    $sql = "UPDATE users SET password = :password WHERE user_id = :user_id";

    $stmt = $this->pdo->prepare($sql);
    $new_password = $new_password;
    $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    try {
      $stmt->execute(['password' => $new_hashed_password, 'user_id' => $this->user_id]);
      $this->set_password($new_password);

      return ['reset' => true, 'message' => 'Password already exists!'];
    } catch (PDOException $e) {
      if ($e->getCode() === 23000) {
        return ['reset' => false, 'message' => 'Password already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function change_username($new_username, $user_id, $old_username)
  {
    $sql = "UPDATE users SET username = :new_username WHERE (user_id = :user_id) AND (username = :old_username)";

    $stmt = $this->pdo->prepare($sql);

    $new_username = htmlspecialchars(strip_tags($new_username));
    try {
      $stmt->execute(['new_username' => $new_username, 'user_id' => $user_id, 'old_username' => $old_username]);
      $this->set_username($new_username);
      return ['reset' => true, 'message' => 'Username changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() === 23000) {
        return ['reset' => false, 'message' => 'Username already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function change_email($new_email, $user_id, $old_email)
  {
    $sql = "UPDATE users SET email = :email WHERE (user_id = :user_id) AND (email = :old_email)";

    $stmt = $this->pdo->prepare($sql);
    $new_email = htmlspecialchars(strip_tags($new_email));
    try {
      $stmt->execute(['email' => $new_email, 'user_id' => $user_id, 'old_email' => $old_email ]);
      $this->set_email($new_email);
      return ['reset' => true, 'message' => 'Email changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() === 23000) {
        return ['reset' => false, 'message' => 'Email already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function change_phone_number($new_phone_number, $user_id, $old_phone_number)
  {
    $sql = "UPDATE users SET phone_number = :phone_number WHERE (user_id = :user_id) AND (phone_number = :old_phone_number)";

    $stmt = $this->pdo->prepare($sql);

    $new_phone_number = htmlspecialchars(strip_tags($new_phone_number));
    try {
      $stmt->execute(['phone_number' => $new_phone_number, 'user_id' => $user_id, 'old_phone_number' => $old_phone_number]);
      $this->set_phone_number($new_phone_number);
      return ['reset' => true, 'message' => 'Phone number changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() === 23000) {
        return ['reset' => false, 'message' => 'Phone number already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function change_password($password, $user_id, $old_password) {
    $sql = "UPDATE users SET password = :password WHERE (user_id = :user_id) AND (password = :old_password)";

    $stmt = $this->pdo->prepare($sql);

    $password = htmlspecialchars(strip_tags($password));
    try {
      $stmt->execute(['password' => $password, 'user_id' => $user_id, 'old_password' => $old_password]);
      $this->set_password($password);
      return ['reset' => true, 'message' => 'Password changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() === 23000) {
        return ['reset' => false, 'message' => 'Password already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  // public function change_role($new_role)
  // {
  //   $sql = "UPDATE users SET role = :role WHERE user_id = :user_id";

  //   $stmt = $this->pdo->prepare($sql);

  //   $new_role = htmlspecialchars(strip_tags($new_role));

  //   try {
  //     $stmt->execute(['role' => $new_role, 'user_id' => $this->user_id]);
  //     $this->set_role($new_role);
  //     return ['reset' => true, 'message' => 'Role changed successfully!'];
  //   } catch (PDOException $e) {
  //     // The role is not required to be unique so we don't need to check for 23000 error code
  //     return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
  //   }
  // }
}