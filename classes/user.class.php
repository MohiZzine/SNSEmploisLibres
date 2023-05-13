  <?php

  require_once '../classes/database.class.php';

  class User
  {
    private $user_id;
    private $username;
    private $full_name;
    private $email;
    private $password;
    private $role;
    private $pdo;

    // Now I need to add a constructor to the class to initialize the database connection
    // Knowing I created a file in the utils folder called database.php where I have the connection to the database
    public function __construct($db)
    {
      $this->pdo = $db;
    }

    public function setAttributes($username, $full_name, $email, $password, $role)
    {
      $this->username = $username;
      $this->full_name = $full_name;
      $this->email = $email;
      $this->password = $password;
      $this->role = $role;
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

    public function register()
    {
      $sql = "INSERT INTO users (username, full_name, email, password, role) VALUES(:username, :full_name, :email, :password, :role)";
      $stmt = $this->pdo->prepare($sql);

      $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

      if ($stmt->execute(['username' => $this->username, 'full_name' => $this->full_name, 'email' => $this->email, 'password' => $hashed_password, 'role' => $this->role])) {
        // Get user_id from the database

        return $this->pdo->lastInsertId();
      }
      return false;
    }

    public function login($username, $password)
    {
      $sql = "SELECT * FROM users WHERE username = :username";

      $stmt = $this->pdo->prepare($sql);

      $stmt->execute(['username' => $username]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
        if (password_verify($password, $result['password'])) {
          ['full_name' => $full_name, 'username' => $username, 'email' => $email, 'password' => $password, 'role' => $role] = $result;
          $this->setAttributes($username, $full_name, $email, $password, $role);
          return true;
        }
        return 'Password is incorrect';
      }
      return false;
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

    public function change_username($new_username)
    {
      $sql = "UPDATE users SET username = :username WHERE user_id = :user_id";

      $stmt = $this->pdo->prepare($sql);

      $new_username = htmlspecialchars(strip_tags($new_username));
      try {
        $stmt->execute(['username' => $new_username, 'user_id' => $this->user_id]);
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

    public function change_email($new_email)
    {
      $sql = "UPDATE users SET email = :email WHERE user_id = :user_id";

      $stmt = $this->pdo->prepare($sql);
      $new_email = htmlspecialchars(strip_tags($new_email));
      try {
        $stmt->execute(['email' => $new_email, 'user_id' => $this->user_id]);
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

    public function change_role($new_role)
    {
      $sql = "UPDATE users SET role = :role WHERE user_id = :user_id";

      $stmt = $this->pdo->prepare($sql);

      $new_role = htmlspecialchars(strip_tags($new_role));

      try {
        $stmt->execute(['role' => $new_role, 'user_id' => $this->user_id]);
        $this->set_role($new_role);
        return ['reset' => true, 'message' => 'Role changed successfully!'];
      } catch (PDOException $e) {
        // The role is not required to be unique so we don't need to check for 23000 error code
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }
