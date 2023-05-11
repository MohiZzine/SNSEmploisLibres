<?php $title = "Login"; ?>
<?php include_once('../includes/header.php') ?>
<link rel="stylesheet" href="../styles/main.css">
</head>

<body class="font-inter text-white bg-gray-700 min-h-screen">
  <header id="nav_bar">
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

  <section id="login" class="container mx-auto h-full flex flex-col items-center justify-center">
    <h1 class="uppercase p-4 text-center text-6xl">Sign In</h1>
    <form action="../db/login.php" method="get" class="w-full max-w-md flex flex-col items-center justify-center gap-4">
      <input type="text" name="name" id="name" placeholder="Name" class="placeholder:italic placeholder-white bg-transparent border-b-2 border-white focus:border-none focus:border-transparent">
      <input type="password" name="password" id="password" placeholder="Password" class="placeholder-italic placeholder-white bg-transparent border-b-2 border-white focus:border-none focus:border-transparent">
      <button type="submit" class="w-1/2 uppercase bg-green-500 text-white font-bold border-transparent p-1.5 hover:bg-green-600 hover:text-gray-200">Sign In</button>
      <div class="flex items-center justify-between">
        <p class="text-sm"><input type="checkbox" name="remember" id="remember"> Remember Me</p>
        <a href="" class="text-sm">Forgot Password</a>
      </div>
    </form>
  </section>


  <?php include_once('../includes/footer.php') ?>