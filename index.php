<?php $title = "Login"; ?>
<?php include_once('includes/header.php') ?>
<?php
if (isset($_GET['error'])) {
  $error = $_GET['error'];
}


?>

<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/input.css">
</head>

<body class="font-inter text-white bg-gray-700 max-h-screen">
  <header id="nav_bar">
    <?php include_once('includes/navbar.php') ?>
  </header>

  <section id="login" class="container mx-auto flex flex-col items-center justify-center gap-6">
    <h1 class="uppercase p-4 text-center text-3xl mt-28">Login</h1>
    <form action="db/login_handler.php" method="POST" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="text" name="username_or_email" id="username_or_email" placeholder="Username / Email " class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2 transparent-auto-fill">
      <input type="password" name="password" id="password" placeholder="Password" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <button type="submit" id="login-btn" name="login" class="w-1/2 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-3 border-transparent hover:bg-green-600 hover:text-gray-200">Login</button>
      <?php if (isset($error)) : ?>
        <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php echo isset($error) ? $error : ''; ?>
        </small>
        <?php endif; ?>
      <div id="recovery" class="flex items-center justify-between gap-4 text-center">
        <p class="text-sm mx-6"><a href="views/register.php" class="hover:cursor-pointer hover:text-gray-500">Sign Up</a></p>
      </div>
    </form>
  </section>

  <?php include_once('includes/footer.php'); ?>