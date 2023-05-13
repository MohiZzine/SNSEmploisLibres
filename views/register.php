<?php $title = "Register"; ?>
<?php include_once('../includes/header.php') ?>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/input.css">
</head>

<body class="h-full font-inter text-white bg-gray-700">
  <header id="nav_bar" class="m-1">
    <?php include_once('../includes/navbar.php'); ?>
  </header>

  <section id="register" class="container mx-auto flex flex-col items-center justify-center gap-4">
    <h1 class="uppercase p-4 text-center text-3xl mt-3">Register</h1>
    <form action="../db/register_handler.php" method="POST" class="w-full flex flex-col items-center justify-center gap-4">
      <div class="w-full flex items-center justify-around">
        <input type="text" name="username" id="username" placeholder="Username" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2 transparent-auto-fill">
        <input type="text" name="full_name" id="full_name" placeholder="Full name" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2">
        <input type="text" name="role" id="role" placeholder="Role" class=" placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2">
      </div>
      <div class="w-full flex items-center justify-around">
        <input type="email" name="email" id="email" placeholder="Email" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2">
        <input type="password" name="password" id="password" placeholder="Password" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 focus:outline-none">
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Password Confirmation" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 focus:outline-none">
      </div>
      <div class="w-full flex items-center justify-around">
        <input type="text" name="phone_number" id="phone_number" placeholder="Telephone" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 focus:outline-none">
      </div>
      <div class="w-full flex items-center justify-center">
        <button type="submit" name="register" id="register" class="w-1/4 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-8 mt-10 border-transparent hover:bg-green-600 hover:text-gray-200">Register</button>
      </div>
      <div id="recovery" class="flex items-center justify-around gap-4 text-center">
        <p class="text-sm mx-6"><a href="login.php" class="hover:cursor-pointer hover:text-gray-500">Sign In</a></p>
      </div>
    </form>
  </section>

  <!-- <script src="../js/login_script.js" defer></script> -->
  <?php include_once('../includes/footer.php') ?>