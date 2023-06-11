<?php
session_start();
$title = "Change Password";
include_once '../includes/header.php';
?>

<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/input.css">
</head>

<body class="font-inter text-white bg-gray-700 max-h-screen">
  <header id="nav_bar">
    <?php include_once('../includes/navbar.php') ?>
  </header>

  <section id="login" class="container mx-auto flex flex-col items-center justify-center gap-6">
    <h1 class="uppercase p-4 text-center text-3xl mt-28">Change Password</h1>
    <form action="../db/reset/password.php" method="POST" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2 transparent-auto-fill">
      <input type="password" name="new_password" id="new_password" placeholder="New Password" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="password" name="repeat_new_password" id="repeat_new_password" placeholder="Repeat New Password" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <button type="submit" id="change-password-btn" name="change_password" class="w-1/2 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-3 border-transparent hover:bg-green-600 hover:text-gray-200">Update</button>
      <?php if (isset($_GET['error'])) : ?>
        <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?>
        </small>
        <?php endif; ?>
      <!-- <div id="recovery" class="flex items-center justify-between gap-4 text-center">
        <p class="text-sm mx-6"><a href="views/register.php" class="hover:cursor-pointer hover:text-gray-500">Sign Up</a></p>
        <p class="text-sm mx-6"><a href="views/forgot_password.php" class="hover:cursor-pointer hover:text-gray-500">Forgot Password</a></p> -->
      </div>
    </form>
  </section>

  <?php include_once('../includes/footer.php'); ?>