<?php $title = "Login"; ?>
<?php include_once('../includes/header.php') ?>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/login.css">
</head>

<body class="font-inter text-white bg-gray-700 min-h-screen">
  <header id="nav_bar" class="m-6">
    <div class="flex container mx-auto items-center justify-between m-3">
      <div class="flex space-x-12">
        <a href="contact.php" class="hover:cursor-pointer hover:text-gray-300">Contact</a>
      </div>
      <img src="" alt="logo">
      <div class="flex space-x-12">
        <a href="about.php" class="hover:cursor-pointer hover:text-gray-300">About</a>
      </div>
    </div>
  </header>

  <section id="login" class="container mx-auto h-full flex flex-col items-center justify-center gap-6">
    <h1 class="uppercase p-4 text-center text-3xl mt-28">Sign In</h1>
    <form action="../db/login.php" method="get" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="text" name="name" id="name" placeholder="Name" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:outline-none focus:border-b-2">
      <input type="password" name="password" id="password" placeholder="Password" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl pr-28 py-2 border-white text-md focus:border-b-2 focus:outline-none">
      <button type="submit" name="login" id="login" class="w-1/2 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-3 border-transparent hover:bg-green-600 hover:text-gray-200">Sign In</button>
      <div class="w-1/2 flex items-center justify-between gap-4 text-center">
        <p class="text-sm mx-6 px-6"><a href="" class="hover:cursor-pointer hover:text-gray-500">Sign Up</a></p>
        <p class="text-sm mx-5"><a href="" class="hover:cursor-pointer hover:text-gray-500">Forgot Password</a></p>

      </div>
    </form>
  </section>


  <?php include_once('../includes/footer.php') ?>