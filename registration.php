<?php include_once 'header.php'; include_once 'menu.php'; ?>
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="images/bg/bg1.jpg" style="background-image: url(&quot;images/bg/bg1.jpg&quot;);">
      <div class="container pt-120 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-md-6">
              <h2 class="text-theme-colored2 font-36">Applicant's Registration</h2>
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
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name: </label>
                            <input type="text" class="form-control" id="fname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name: </label>
                            <input type="text" class="form-control" id="lname">
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      <label>Email: </label>
                      <input type="text" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                      <label>Password: </label>
                      <input type="password" class="form-control" id="pass">
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                              <label>Phone Number: </label>
                              <input type="text" class="form-control" id="phone">
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gender: </label>
                            <select class="form-control" id="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                      
                      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal">Submit</button>
                  </div>
                  
                  <!-- popup start -->
                  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registration Instruction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- start -->
        <ul>
            <li>Register on our website. To register click on the tab ‘registration’ on the top of the page. Fill your name, email address, gender, and mobile phone number. Create your password and enter in the space password. Very important that you make a note of your ID (email address) and Password. You will need to use this ID and Password to apply and to check the status of the application.</li> 
<br>
            <li>If you forget the password, you can retrieve it by clicking the forgot the password and follow the steps after. </li>
<br>
            <li>You will not be able to change your ID which is your email address so keep a note of it. </li>
<br>
            <li>After you complete the registration you will receive an email (i.e. your ID). Click to confirm in your email then it will take you back to our website.</li>
<br>
            <li>You need to ‘sign in’ on the website using your ID (i.e. email address) and Password. </li>
<br>
            <li>Once you have signed in, a page will open where you choose the type of the application (Scholarship or Extracurricular activities (EC) or both). </li>
<br>
            <li>If have any questions email us at name@yourdomain.org</li>
        </ul>
<div id="registration_error"></div>
        <!-- end -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-block" onclick="register()">Register Now</button>
      </div>
    </div>
  </div>
</div>
                  <!-- popup end -->
                  
                  
                  <p align="center">Already a member? <a href="login.php"><b>Login Now</b></a></p>
              </div>
          </div>
        </div>
      </div>
    </section>
<?php include_once 'footer.php'; ?>