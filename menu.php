<header id="header" class="header">
    <div class="header-top bg-theme-colored border-top-theme-colored2-2px sm-text-center">
      <div class="container">
        <div class="row">          
          <div class="col-md-6">
            <div class="widget">
              <ul class="styled-icons icon-sm icon-white">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="widget">
              <ul class="list-inline text-right flip sm-text-center">
                <li>
                  <a class="text-white" href="#">FAQ</a>
                </li>
                <li class="text-white">|</li>
                <li>
                  <a class="text-white" href="#">Help Desk</a>
                </li>
                <li class="text-white">|</li>
                <li>
                  <a class="text-white" href="#">Support</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
          <nav id="menuzord-right" class="menuzord default theme-colored">
          <a class="menuzord-brand pull-left flip mt-20 mt-sm-10 mb-sm-20 pt-5" href="index-mp-layout1.html">
            <img src="images/logo.png" style="width:100px;" alt="">
          </a>
            <ul class="menuzord-menu">
                <?php if(isset($_SESSION['email'])){ ?>
                        <li><a href="dashboard.php">Dashboard</a>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="status.php">Form Status</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        
                        <!--<li><a href="javascript:void(0)">Shortcodes <span class="label label-danger">New</span></a>-->
                <?php }else{ ?>
                      <li><a href="index.php">Home</a></li>
                      <li><a href="login.php">Login</a></li>
                      <li><a href="./admin">Org Login</a></li>
                      <li><a href="registration.php">Signup</a></li>
              
                <?php } ?>
              
                
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>