<!-- Sidebar Start -->
<aside class="left-sidebar" style="height: 100vh;">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?php echo $_SESSION['user_role'] == 'artisan' ? 'dashboardArtisan.php' : 'dashboardUser.php' ?>"
        class="text-nowrap logo-img">
        <img src="assets/global.png" width="" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="font-size: 2em; overflow: hidden;">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link"
            href="<?php echo $_SESSION['user_role'] == 'artisan' ? 'dashboardArtisan.php' : 'dashboardUser.php' ?>"
            aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">MENU</span>
        </li>
        <!-- <li class="sidebar-item">
          <a class="sidebar-link" aria-expanded="false">
            <span>
              <i class="ti ti-login"></i>
            </span>
            <span class="hide-menu">Your Requests</span>
          </a>
        </li> -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="reviews.php" aria-expanded="false">
            <span>
              <i class="ti ti-user-plus"></i>
            </span>
            <span class="hide-menu">Your Reviews</span>
          </a>
        </li>
        <!-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">ACCOUNT SETTINGS</span>
        </li>
        <form action="../db/dashboard_handler.php" method="post">
          <li class="sidebar-item">
            <a class="sidebar-link" aria-expanded="false">
              <span>
                <i class="ti ti-alert-circle"></i>
              </span>

              <button name="change_username"
                style=" background: none; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                <span class="hide-menu">Change Username</span>
              </button>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" aria-expanded="false">
              <span>
                <i class="ti ti-file-description"></i>
              </span>
              <button name="change_email"
                style=" background: none; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                <span class="hide-menu">Change Email</span>
              </button>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" aria-expanded="false">
              <span>
                <i class="ti ti-file-description"></i>
              </span>
              <button name="change_phone_number"
                style=" background: none; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                <span class="hide-menu">Change Phone Number</span>
              </button>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" aria-expanded="false">
              <span>
                <i class="ti ti-cards"></i>
              </span>
              <button name="change_password"
                style=" background: none; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                <span class="hide-menu">Change Password</span>
              </button>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" aria-expanded="false">
              <span>
                <i class="ti ti-article"></i>
              </span>
              <button name="logout"
                style=" background: none; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                <span class="hide-menu">Log Out</span>
              </button>
            </a>
          </li>
        </form>

      </ul>
      <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                <a href="" target="_blank"
                  class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
              </div>
              <div class="unlimited-access-img">
                <img src="" alt="" class="img-fluid">
              </div>
            </div>
          </div> -->
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper">
  <!--  Header Start -->
  <header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li> -->
      </ul>
      <!-- <div id="navbarNav" class="navbar-collapse justify-content-end px-0 bg-slate-800">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="../utils/logout.php" target="_blank"
                class="btn btn-danger">Log Out</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div> -->
    </nav>
  </header>