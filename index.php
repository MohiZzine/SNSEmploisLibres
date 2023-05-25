<?php session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
  exit;
}

$title = "Home";
include('includes/header.php');
?>
<link rel="stylesheet" href="styles/main.css">
</head>

<body class="bg-white">
  <p class="text-center text-3xl text-blue-500">
    Hello <?php echo $_SESSION['full_name'] ?>!
  </p>



  <?php include 'includes/footer.php'; ?>