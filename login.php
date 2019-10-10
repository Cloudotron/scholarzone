<?php include_once 'header.php'; include_once 'menu.php'; ?>
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="images/bg/bg1.jpg" style="background-image: url(&quot;images/bg/bg1.jpg&quot;);">
      <div class="container pt-120 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-6">
              <h2 class="text-theme-colored2 font-36">Login to ScholarZone</h2>
              <ol class="breadcrumb text-left mt-10 white">
                <li><a href="#">Home</a></li>
                <li class="active">Login</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    
<section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-push-3">
            <div class="border-1px p-25">
              <h4 class="text-theme-colored text-uppercase m-0">Login</h4>
              <div class="line-bottom mb-30"></div>
              <div>
                  <div class="form-group">
                      <label>Email: </label>
                      <input type="text" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                      <label>Password: </label>
                      <input type="password" class="form-control" id="pass">
                  </div>
                  
                  
                  <div id="login_error"></div>
                  <div class="form-group">
                      <button class="btn btn-success btn-block" onclick="login()">Submit</button>
                  </div>
                  <p align="center">Not a member yet? <a href="registration.php"><b>Register Now</b></a> | Forgot Password? <a href=""><b>Click Here</b></a></p>
              </div>
          </div>
        </div>
      </div>
    </section>
<?php include_once 'footer.php'; ?>