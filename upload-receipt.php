<?php 
    include_once("header.php");
    include_once("menu.php"); 
    if(!isset($_SESSION['email']) || $_SESSION['email'] == "" || $_SESSION['email'] == " "){
        header("location:logout.php");
    }
    include_once("script.php");
    $script = new script;
    $uinfo=$script->uinfo($_SESSION['email']);
    $sch = $script->getSchDate($uinfo['uid']);
    //var_dump($sch);
    $m = "";
    if($uinfo['ec_status'] == "" && $sch['sub_date'] == ""){
        $m="Please complete any of the application to get the status";
    }
?>
  
  <!-- Start main-content -->
  <div class="main-content">
    <section id="blog">
      <div class="container pb-sm-40">
        <div class="section-title mb-40">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-uppercase mb-5">Application <span class="text-theme-colored2">Status</span></h2>
              <h5 class="font-16 text-gray-darkgray mt-5">Prevew of your submitted form</h5>
            </div>
          </div>
        </div>


        <div class="section-content">
            
            
            <?php if($m == "") { ?>
            
          <div class="row">
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload receipt</label>
                            <input type="file" class="form-control" name="rec">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="sub">
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['sub'])){
                            $fname = $_FILES['rec']['name'];
                            $tfname = $_FILES['rec']['tmp_name'];
                            $uid = $uinfo['uid'];
                            if($script->processReceipt($fname,$tfname,$uid)){
                                echo "Uploaded!";
                            }
                        }
                    ?>
                </div>
                <div class="col-md-4">
                  
                </div>
          </div>
            <?php }else{ ?>
                <?php echo '<h3>'.$m.'</h3>'; ?>
            <?php } ?>
          
          
          
        </div>



      </div>
    </section>

  </div>
  
  <!-- end main-content -->
  <!-- Footer -->
  <?php include_once("footer.php"); ?>