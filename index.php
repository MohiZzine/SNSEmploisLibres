<?php $title = "Home"; ?>
<?php if (isset($_SESSION['user'])) {
  include_once('includes/header.php');
} else {
  header('Location: login.php');
}
?>