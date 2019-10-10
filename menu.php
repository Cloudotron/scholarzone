<header id="header" class="header">
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
          <nav id="menuzord-right" class="menuzord default theme-colored">
          <a class="menuzord-brand pull-left flip mt-20 mt-sm-10 mb-sm-20 pt-5" href="index-mp-layout1.html">
            <img src="images/logo.png" style="margin-top:-13px;" alt="">
          </a>
            <ul class="menuzord-menu">
                <?php if(isset($_SESSION['email'])){ ?>
                        <li><a href="dashboard.php">Dashboard</a>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="status.php">Form Status</a></li>
                        <li><a href="logout.php">Logout</a></li>
                <?php }else{ ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Student Login</a></li>
                        <li><a href="./admin">Org Login</a></li>
                        <li><a href="registration.php">Student Signup</a></li>
                        <li><a href="provider-registration.php">Org Signup</a></li>
                <?php } ?>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!--
1. put the list of scholarship
2. verify by aadhar and pan
3. keep track of all the applications in student oortal
4. 
    -->