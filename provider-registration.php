<?php include_once 'header.php'; include_once 'menu.php'; ?>
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="images/bg/bg1.jpg" style="background-image: url(&quot;images/bg/bg1.jpg&quot;);">
      <div class="container pt-120 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-6">
              <h2 class="text-theme-colored2 font-36">Scholarship providers's Registration</h2>
              <ol class="breadcrumb text-left mt-10 white">
                <li><a href="#">Home</a></li>
                <li class="active">Registration</li>
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
              <h4 class="text-theme-colored text-uppercase m-0">Registration</h4>
              <div class="line-bottom mb-30"></div>
              <div>
                  <form method="post"> 
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name: </label>
                            <input type="text" class="form-control" name="fname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name: </label>
                            <input type="text" class="form-control" name="lname">
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <label>Email: </label>
                      <input type="text" class="form-control" name="email">
                  </div>
                  <div class="form-group">
                      <label>Organization: </label>
                      <input type="text" class="form-control" name="org">
                  </div>
                  <div class="form-group">
                      <label>Password: </label>
                      <input type="password" class="form-control" name="pass">
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                              <label>Phone Number: </label>
                              <input type="text" class="form-control" name="phone">
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gender: </label>
                            <select class="form-control" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      
                      <input type="submit" name="submit" class="btn btn-success btn-block" />
                  </div>
</form>
                  <?php 
                        if(isset($_POST['submit'])){
                            include_once("script.php");
                            $script = new script();
                                if($script->org_register($_POST)){
                                    echo "<h3>Registration completed!</h3>";
                                }else{
                                    echo "<h3>Failed to add registration</h3>";
                                }
                        }
                  ?>
                  
                 
                  
                  
                  <p align="center">Already a member? <a href="login.php"><b>Login Now</b></a></p>
              </div>
          </div>
        </div>
      </div>
    </section>
<?php include_once 'footer.php'; ?>