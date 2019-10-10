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
        $m="Please complete any of the application, if approved, you will get to renew it.";
    }
?>
  
  <!-- Start main-content -->
  <div class="main-content">
    <section id="blog">
      <div class="container pb-sm-40">
        <div class="section-title mb-40">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-uppercase mb-5">Application <span class="text-theme-colored2">Renew</span></h2>
              <h5 class="font-16 text-gray-darkgray mt-5">Renew your application form</h5><hr>
              <h4><?php echo strtoupper($uinfo['fname'].' '.$uinfo['lname']); ?> (MF<?php echo $uinfo['uid']; ?>)</h4>
            </div>
          </div>
        </div>


        <div class="section-content">
            
            
            <?php if($m == "") { ?>
            
          <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <?php //print_r($sch); ?>
                          <form method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label>Apllying Semester/Year: </label>
                                  <?php 
                                    if($sch['apply_phase'] < $sch['total_phase']){ ?>
                                        <input disabled type="text" name="asem" class="form-control" value="<?php echo $sch['apply_phase']+1; ?>">
                                   <?php }
                                  ?>
                                  
                              </div>
                              <div class="form-group">
                                  <label>Last year/Semester marks Card: </label>
                                  <input type="file" name="mc" class="form-control">
                              </div>
                              <div class="form-group">
                                  <input type="submit" name="sub" class="btn btn-primary btn-block">
                              </div>
                          </form>
                          <?php 
                            if(isset($_POST['sub'])){
                                $sem = $sch['apply_phase']+1;
                                $uid= $uinfo['uid'];
                                $filename=$_FILES['mc']['name'];
                                $filetmp=$_FILES['mc']['tmp_name'];
                                $sql = $script->reapply($uid,$filename,$filetmp,$sem);
                                if($sql){
                                    echo "<h3>Re-apply request submitted!</h3>";
                                }else{
                                    echo "<h3>Failed to re apply!</h3>";
                                }
                            }
                          ?>
                          
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
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