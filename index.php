<?php $title = "Home"; ?>

<?php if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
} else {
  include('includes/header.php');
}
?>
</head>

<body class="bg-white">
  <p class="text-center text-3xl text-gray-900">
    Hello <?php echo $_SESSION['name'] ?>!
  </p>


  <?php include 'includes/footer.php'; ?>