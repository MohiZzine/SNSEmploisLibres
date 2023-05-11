<?php $title = "Home"; ?>

<?php if (!isset($_SESSION['user'])) {
  header('Location: views/login.php');
} else {
  include_once('includes/header.php');
}
?>
</head>

