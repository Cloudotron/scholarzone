<?php include_once("header.php"); 
include_once("script.php");
$script = new script;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
          
          <div class="row">
              <div class="col-md-12">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Scholarship Application</a>
                          </li>
                          
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Notification</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">Receipt</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">Reapply</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">Notes</a>
                          </li>
                        </ul>
                        
                        
                        <div class="tab-content">
                          <div class="tab-pane container active" id="home">
                              <!-- scholarship start -->
                              <?php $script->getScholarshipData($_GET['uid']); ?>
                                <p align="center">
                                    <!-- <a href="#" class="btn btn-sm btn-success">Accept</a> 
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                    -->
                                    <?php 
                                        $n = $script->uinfo($_GET['uid']);
                                        switch($n['sch_status']){
                                            case "A": ?>
                                                <div class="form-group" align="center">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal15">Reject</button>
                                                
                                                </div>
                                            <?php break;
                                            
                                            case "R":?>
                                                <div class="form-group" align="center">
                                                    <a href="accept.php?app=1&uid=<?php echo $_GET['uid']; ?>" class="btn btn-success">Accept</a>
                                                </div>
                                            <?php break;
                                            
                                            case "INT": ?>
                                                <p class="alert alert-info">Last Interview Scheduled on: <b><?php echo $script->get_scheduled_date($_GET['uid']); ?></b></p>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal1">Re-Schedule Interview</button>
                                                
                                                <a href="int-done.php?uid=<?php echo $_GET['uid']; ?>&form=1" class="btn btn-primary">Interview Done</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal15">Reject</button>
                                                
                                            <?php break;
                                            case "INTC":
                                                ?>
                                                    <hr><h3 align="center">Final action for the application</h3>
                                                <div class="form-group" align="center">
                                                    <a href="accept.php?app=1&uid=<?php echo $_GET['uid']; ?>" class="btn btn-success">Accept</a> &nbsp; 
                                                    
                                                    <!-- Link to open the modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal15">Reject</button>
                                                
                                                </div>
                                            <?php
                                            break;
                                            
                                            default: ?>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal15">Reject</button>
                                                
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1">Schedule Interview</button>
                                                
                                           <?php break;
                                        }
                                        ?>
                                    
                                </p>
                                
                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Select Date and Time for the interview</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Date and time: </label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="text" id="datetimes" name="datetimes" value="" placeholder="Select a date" class="form-control"/>
                                                            <script>
                                                            var v =
                                                                $(function() {
                                                                  $('input[name="datetimes"]').daterangepicker({
                                                                    singleDatePicker: true,
                                                                     showDropdowns: true,
                                                                    startDate: moment().startOf('hour'),
                                                                    endDate: moment().startOf('hour').add(32, 'hour'),
                                                                    locale: {
                                                                      format: 'DD-MM-YYYY'
                                                                    }
                                                                  }
                                                                  );
                                                                });
                                                            </script><br>
                                                            <div class="alert alert-success" id="res"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    $n = $script->uinfo($_GET['uid']);
                                                    if($n['sch_status'] == "INT"){ ?>
                                                        <div class="form-group">
                                                            <button class="btn btn-block btn-warning" onclick="schedule_interview2('<?php echo $_GET['uid']; ?>')">Submit</button>
                                                        </div>
                                                    <?php }else{ ?>
                                                        <div class="form-group">
                                                            <button class="btn btn-block btn-primary" onclick="schedule_interview('<?php echo $_GET['uid']; ?>')">Submit</button>
                                                        </div>
                                                <?php } ?>

                                              </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     
                                    <div class="modal fade" id="exampleModal15" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Rejection</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <p>Enter Comment: </p>
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="r_note"></textarea>
                                                            </div>
                                                            <button class="btn btn-block btn-danger" onclick="reject('1','<?php echo $n['uid']; ?>')">Reject</button>
                                                            <div id="ec_res"></div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                
                                
                              <!-- scholarship end -->
                            </div>
                          
                          <div class="tab-pane container fade" id="menu2">
                              <?php
                              $script->getStatus($_GET['uid']);
                              ?>
                          </div>
                          <div class="tab-pane container fade" id="menu3">
                              
                              <br>
                                <div class="form-group">
                                    <label>Type your comments about this application: </label>
                                    <textarea class="form-control" id="note" placeholder="Write your comments..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning btn block" onclick="save_my_notes('<?php echo $n['uid']; ?>')">Save</button>
                                </div>
                                <div id="result"></div>
                                <div id="notes_list">
                                        
                                </div>
                                <script>
                                    window.onload = get_all_notes('<?php echo $n['uid']; ?>');
                                </script>
                                
                                
                          </div>
                          <div class="tab-pane container fade" id="menu5">
                              <br>
                              <?php $script->getReapply($_GET['uid']); ?>
                                
                          </div>
                          <div class="tab-pane container fade" id="menu4">
                              <br>
                              <?php $script->getReceipt($_GET['uid']); ?>
                                
                          </div>
                          
                          
                        </div>
                    </div>
                </div>
              </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once("footer.php"); ?>