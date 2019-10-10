<?php 
include_once("header.php");
include_once("menu.php");
include_once("script.php");
if(!isset($_SESSION['email'])){
    header("location:logout.php");
}
$script = new script();
$uinfo=$script->uinfo($_SESSION['email']);

//echo $_SESSION['email'];
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Hi <?php echo strtoupper($uinfo['fname'].' '.$uinfo['lname']); ?></h3>
            <p><i>Enrollment No.: MF<?php echo $uinfo['uid']; ?> | Email: <?php echo $uinfo['email']; ?></i></p>
        </div>
    </div>
<div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4 mb-sm-30">
            <div class="feature-box text-center bg-silver-light p-30 pb-20">
              <div class="feature-icon">
                <img src="images/icons/1.png" alt="">
              </div>
              <div class="feature-title">
                <h3>Education Scholarship Application</h3>
                
                <p>
                    <form method="post">
                        <input type="submit" name="sub" class="btn btn-primary btn-block" value="Proceed Now">
                    </form>
                    <?php 
                        if(isset($_POST['sub'])){
                            if($script->StartForm($_SESSION['email'],"1")){
                                header("location:apply-now.php");
                            }
                        }
                    ?>
                </p>
                <h4>Status: <?php echo $script->scholarship_dashboard($uinfo['uid']) ?></h4>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="feature-box text-center bg-silver-light p-30 pb-20">
              <div class="feature-icon">
                <img src="images/icons/3.png" alt="">
              </div>
              <div class="feature-title">
                <h3>Application Status</h3>
                <p><a href="status.php" class="btn btn-warning btn-block">View Now</a></p>
                <h4>All submitted applications</h4>
              </div>
            </div>
          </div>
          

          




        </div>



        


























</div>

<br>


<?php 
include_once("footer.php");
?>