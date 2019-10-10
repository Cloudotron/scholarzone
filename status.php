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
              <h5 class="font-16 text-gray-darkgray mt-5">Preview of your Submitted Application/Notifications/Upload Receipt</h5><hr>
              <h4><?php echo strtoupper($uinfo['fname'].' '.$uinfo['lname']); ?> (MF<?php echo $uinfo['uid']; ?>)</h4>
            </div>
          </div>
        </div>


        <div class="section-content">
            
            
            <?php if($m == "") { ?>
            
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-primary">
                      <div class="panel-body">
                          
                          
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#home">Educational Scholarship Application</a></li>
                              <li><a data-toggle="tab" href="#menu2">Notifications</a></li>
                              <li><a data-toggle="tab" href="#menu3">Upload Receipt</a></li>
                            </ul>
                            
                            <div class="tab-content">
                              <div id="home" class="tab-pane fade in active">
                                <h3 align="center">Educational Scholarship Application Preview</h3>
                                <div id="sch">
                                    <?php 
                                    if($sch['sub_date'] == ""){
                                        echo "Incomplete scholarship form. Please fillup the scholarship form to get the details here.";
                                    }else{
                                        $script->getSchForm($uinfo['uid']); 
                                        $script->putSchDoc($uinfo['uid']);
                                    }
                                    ?>
                                </div>
                              </div>
                              <div id="menu2" class="tab-pane fade">
                                <h3>Application updates</h3>
                                <?php $script->getStatus($uinfo['uid']); ?>
                              </div>
                              <div id="menu3" class="tab-pane fade">
                                <!-- start -->
                                <div class="row">
                                    <?php 
                                    if($script->checktran($uinfo['uid'])){ ?>
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
                    <br>
                    
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
          <div class="row">
              <div class="col-md-12">
                  <?php echo $script->getReceipt($uinfo['uid']); ?>
              </div>
          </div>
                                    <?php }
                                    ?>
                                  
                                </div>
                                <!-- end -->
                                
                              </div>
                            </div>
                            
                            
                      </div>
                  </div>
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