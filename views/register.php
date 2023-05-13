<?php $title = "Register"; ?>
<?php include_once('../includes/header.php') ?>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/login.css">
</head>

<body class="h-full font-inter text-white bg-gray-700">
  <header id="nav_bar" class="m-1">
    <?php include_once('../includes/navbar.php'); ?>
  </header>

  <section id="register" class="container mx-auto flex flex-col items-center justify-center gap-4">
    <h1 class="uppercase p-4 text-center text-3xl mt-6">Register</h1>
    <form action="../db/register_handler.php" method="get" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="text" name="username" id="username" placeholder="Username" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="text" name="name" id="name" placeholder="Name" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="email" name="email" id="email" placeholder="Email" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="password" name="password" id="password" placeholder="Password" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:border-b-2 focus:outline-none">
      <input type="confirm_password" name="confirm_password" id="confirm_password" placeholder="Password Confirmation" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:border-b-2 focus:outline-none">
      <button type="submit" name="register" id="register" class="w-1/2 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-3 border-transparent hover:bg-green-600 hover:text-gray-200">Register</button>
      <div id="recovery" class="flex items-center justify-between gap-4 text-center">
        <p class="text-sm mx-6"><a href="login.php" class="hover:cursor-pointer hover:text-gray-500">Sign In</a></p>
      </div>
    </form>
  </section>

  <!-- <script src="../js/login_script.js" defer></script> -->
  <?php include_once('../includes/footer.php') ?>