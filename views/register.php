<?php $title = "Register"; ?>
<?php include_once('../includes/header.php') ?>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/login.css">
</head>

<body class="font-inter text-white bg-gray-700 min-h-screen">
  <header id="nav_bar">
    <?php include_once('../includes/navbar.php') ?>
  </header>

  <section id="register" class="container mx-auto h-full flex flex-col items-center justify-center gap-6">
    <h1 class="uppercase p-4 text-center text-3xl mt-28">REGISTER</h1>
    <form action="../db/register.php" method="post" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="text" name="name" id="name" placeholder="Name" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="password" name="password" id="password" placeholder="Password" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <button type="submit" id="register" name="register" class="w-1/2 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-3 border-transparent hover:bg-green-600 hover:text-gray-200">Register</button>
    </form>
  </section>

  <?php include_once('../includes/footer.php'); ?>