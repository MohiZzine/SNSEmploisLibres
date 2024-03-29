<?php session_start();
$title = "Register";
include_once('../includes/header.php');

if (isset($_GET['username'])) {
  $usernameErr = $_GET['username'];
}

if (isset($_GET['full_name'])) {
  $full_nameErr = $_GET['full_name'];
}

if (isset($_GET['email'])) {
  $emailErr = $_GET['email'];
}

if (isset($_GET['password'])) {
  $passwordErr = $_GET['password'];
}

if (isset($GET['confirm_password'])) {
  $confirm_passwordErr = $_GET['confirm_password'];
}

if (isset($_GET['role'])) {
  $roleErr = $_GET['role'];
}

if (isset($_GET['phone_number'])) {
  $phone_numberErr = $_GET['phone_number'];
}

if (isset($_GET['error'])) {
  $error = $_GET['error'];
}

?>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/input.css">
</head>

<body class="h-full font-inter text-white bg-gray-700">
  <header id="nav_bar" class="m-3">
    <?php include_once('../includes/navbar.php') ?>
  </header>

  <section id="register" class="container mx-auto flex flex-col items-center justify-center gap-4">
    <h1 class="uppercase p-4 text-center text-3xl mt-3">Register</h1>
    <form action="../db/register_handler.php" method="POST" class="w-full flex flex-col items-center justify-center gap-4">
      <div class="w-full flex items-center justify-around">
        <div class="flex flex-col items-center justify-center">
          <input type="text" name="username" id="username" placeholder="Username" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2 <?php echo isset($usernameErr) ? 'border-rose-500' : '' ?> transparent-auto-fill">
          <small class="mt-2 m-3 text-center" style="color: red;">
          <?php if (isset($usernameErr)) : ?>
              <?php echo isset($usernameErr) ? $usernameErr : ''; ?>
              <?php endif; ?>
            </small>
        </div>
        <div class="flex flex-col items-center justify-center">
          <input type="text" name="full_name" id="full_name" placeholder="Full name" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2 <?php echo isset($full_nameErr) ? 'border-rose-500' : null ?>">
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($full_nameErr)) : ?>
              <?php echo isset($full_nameErr) ? $full_nameErr : ''; ?>
              <?php endif; ?>
          </small>
        </div>
        <div class="flex flex-col items-center justify-center">
        <select name="role" id="role" class=" placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2">
          <option value="" disabled>Select your role</option>
          <option value="user" style="color: black;" selected>User</option>
          <option value="artisan" style="color: black;">Artisan</option>
        </select>
          <!-- <input type="text" name="role" id="role" placeholder="Role" > -->
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($roleErr)) : ?>
              <?php echo isset($roleErr) ? $roleErr : ''; ?>
              <?php endif; ?>
          </small>
        </div>
      </div>
      <div class="w-full flex items-center justify-around">
        <div class="flex flex-col items-center justify-center">
          <input type="email" name="email" id="email" placeholder="Email" class="placeholder:italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:outline-none focus:border-b-2 <?php echo isset($emailErr) ? 'border-rose-500' : null ?>">
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($emailErr)) : ?>
              <?php echo isset($emailErr) ? $emailErr : ''; ?>
              <?php endif; ?>
            </small>
        </div>
        <div class="flex flex-col items-center justify-center">
          <input type="password" name="password" id="password" placeholder="Password" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 <?php echo isset($passwordErr) ? 'border-rose-500' : null ?> focus:outline-none">
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($passwordErr)) : ?>
              <?php echo isset($passwordErr) ? $passwordErr : ''; ?>
              <?php endif; ?>
          </small>
        </div>
        <div class="flex flex-col items-center justify-center">
          <input type="password" name="confirm_password" id="confirm_password" placeholder="Password Confirmation" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 focus:outline-none <?php echo (isset($_GET['confirm_password'])) ? 'border-rose-500' : null ?>">
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($_GET['confirm_password'])) : ?>
              <?php echo isset($_GET['confirm_password']) ? $_GET['confirm_password'] : ''; ?>
              <?php endif; ?>
          </small>
        </div>
      </div>
      <div class="w-full flex items-center justify-around">
        <div class="flex flex-col items-center justify-center">
          <input type="text" name="phone_number" id="phone_number" placeholder="Telephone" class="placeholder-italic placeholder-white bg-transparent border-b-2 font-3xl px-6 py-2 border-white text-md focus:border-b-2 focus:outline-none <?php echo isset($phone_numberErr) ? 'border-rose-500' : null ?>">
          <small class="mt-2 m-3 text-center text-pink-600" style="color: red;">
          <?php if (isset($phone_numberErr)) : ?>
              <?php echo isset($phone_numberErr) ? $phone_numberErr : ''; ?>
              <?php endif; ?>
            </small>
        </div>
      </div>
      <div class="w-full flex items-center justify-center">
        <button type="submit" name="register" id="register" class="w-1/4 uppercase rounded-sm bg-green-500 text-white font-bold font-lg p-1.5 px-8 mt-10 border-transparent hover:bg-green-600 hover:text-gray-200">Register</button>
      </div>
      <div id="recovery" class="flex items-center justify-around gap-4 text-center">
        <p class="text-sm mx-6"><a href="../index.php" class="hover:cursor-pointer hover:text-gray-500">Sign In</a></p>
      </div>
    </form>
  </section>

  <!-- <script src="../js/login_script.js" defer></script> -->
  <?php include_once('../includes/footer.php') ?>