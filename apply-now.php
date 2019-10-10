<?php 
    include_once("header.php");
    include_once("menu.php"); 
    if(!isset($_SESSION['email']) || $_SESSION['email'] == "" || $_SESSION['email'] == " "){
        header("location:logout.php");
    }
    include_once("script.php");
    $script = new script;
    $uinfo=$script->uinfo($_SESSION['email']);
    $sc = $script->getScholarshipData($_SESSION['email']);
    if($uinfo['phase'] == "4" && $uinfo['sch_status'] != "R"){
        header("location:status.php");
    }
    
?>
  
  <!-- Start main-content -->
  <div class="main-content">
    <section id="blog">
      <div class="container pb-sm-40">
        <div class="section-title mb-40">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-uppercase mb-5">Education Scholarship <span class="text-theme-colored2">Application</span></h2>
              <script>
            function abc(){
                document.getElementById("dialog2").className = "show";
                $( function() {
                    $( "#dialog" ).dialog({
                        modal: true,
                        minWidth: 1000,
                        minHeight: 500
                    });
                });
            }
              </script>
              <h5 class="font-16 text-gray-darkgray mt-5">Do you want to read the instructions? <span onclick="abc()" class="label label-danger" style="cursor:pointer;">Read Again</span></h5>
            </div>
          </div>
        </div>


        <div class="section-content">
            <script>
            
            function abc(){
                $( function() {
                $("#dialog").dialog({
                    modal: true,
                    minWidth: 1000,
                    minHeight: 500
                });
              });
            }
              $( function() {
                $("#dialog").dialog({
                    modal: true,
                    minWidth: 1000,
                    minHeight: 500
                });
              });
            </script>
            <div id="dialog" title="INSTRUCTION FOR THE ‘EDUCATION SCHOLARSHIP’ APPLICATION">
              <p>1. Application has 4 phases- <br><b>Phase-1</b>: Personal Details <br><b>Phase-2</b>: Educational Details <br><b>Phase-3</b>: College bank Details & References <br><b>Phase-4</b>: Upload Documents</p>
              <p>2. Some information is <b>mandatory/compulsory</b> which are depicted by <code>*</code> which you MUST fill in and click on <b>Save</b> button.</p>
              <p>3. You cannot move to the next phase if you haven't completed the current phase. You will notice at the Top of the section showing the phase is <span class="label label-info">In Progress</span></p>
              <p>4. Upon successfully filling each phase you will notice at the Top of the section showing the phase is <span class="label label-success">Completed</span>. Then you can proceed to the next phase. </p>
              <p>5. In <b>Phase 4</b>, you must upload all the required documents. You will be able to upload the documents in any image format (JPG, JPEG, PNG). Please DO NOT Upload PDF file. </p>
              <p>6. Upload the <b>Proof of the income</b> in the form of a pay slip or income tax return or income certificate in <b>Upload Income certificates</b></p>
              <p>7. Upload the <b>Mark-sheet of the last examination</b>. The last examination can be the 10th standard or 12th standard or any last examination of your current course.</p>
              <p>8. Upload your <b>Hand Written</b> ‘Aim of the life’ statement in any image format. Click the <span class="label label-danger">Guide</span>. Guide will inform you what to include in the statement.</p>
              <br><p>If have any questions email us at info@macwanfoundation.org</p>
              <p><kbd>By closing this window you accept that you have understood all the instructions given and ready to fillup the form accordingly.</kbd></p>
              
              <!--<ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Phase 1</a></li>
                  <li><a data-toggle="tab" href="#menu1">Phase 2</a></li>
                  <li><a data-toggle="tab" href="#menu2">Phase 3</a></li>
                  <li><a data-toggle="tab" href="#menu3">Phase 4</a></li>
                </ul>
                
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>Phase 1 Instructions</h3>
                    <p>Some content.</p>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                    <h3>Phase 2 Instructions</h3>
                    <p>Some content in menu 1.</p>
                  </div>
                  <div id="menu2" class="tab-pane fade">
                    <h3>Phase 3 Instructions</h3>
                    <p>Some content in menu 2.</p>
                  </div>
                  <div id="menu3" class="tab-pane fade">
                    <h3>Phase 4 Instructions</h3>
                    <p>Some content in menu 2.</p>
                  </div>
                </div>-->
            </div>
            
            
            
          <div class="row">
            <div class="col-md-12">
                <!-- form start -->
                    <div class="panel-group accordion-theme-colored" id="accordion4" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne4">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                Phase #1 - Personal Details <?php if($uinfo['phase'] == "0"){echo '<span class="label label-info">In Progress</span>';}else{echo '<span class="label label-success">Completed</span>';} ?>
                                </a>
                            </h4>
                            </div>
                            <div id="collapseOne4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne4">
                            <div class="panel-body">
                                <div class="phase1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- phase 1 part 1 --> 
                                            <div class="form-group">
                                                <label>First Name: </label>
                                                <input type="text" class="form-control" id="first_name" value="<?php echo $uinfo['fname']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name: </label>
                                                <input type="text" class="form-control" id="last_name" value="<?php echo $uinfo['lname']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone: </label>
                                                <input type="text" class="form-control" id="phone" value="<?php echo $uinfo['phone']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Email: </label>
                                                <input type="text" class="form-control" id="email" value="<?php echo $uinfo['email']; ?>" disabled>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Address: <code>*</code> </label>
                                                <textarea class="form-control" id="address"><?php echo $sc['addr']; ?></textarea>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <!-- phase 1 part 2 --> 
                                            <div class="form-group">
                                                <label>Pincode:<code>*</code> </label>
                                                <input type="text" class="form-control" id="pin" value="<?php echo $sc['pin']; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Father's Name:<code>*</code> </label>
                                                <input type="text" class="form-control" id="fat_name" value="<?php echo $sc['fname']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Occupation:<code>*</code> </label>
                                                <select class="form-control" id="foccu">
                                                    <option value="service">Service</option>
                                                    <option value="business">Business</option>
                                                    <option value="retired">Retired</option>
                                                    <option value="not_working">Not Working</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Mother's Name:<code>*</code> </label>
                                                <input type="text" class="form-control" id="mot_name" value="<?php echo $sc['mname']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Occupation:<code>*</code> </label>
                                                <select class="form-control" id="moccu">
                                                    <option value="service">Service</option>
                                                    <option value="business">Business</option>
                                                    <option value="retired">Retired</option>
                                                    <option value="not_working">Not Working</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <p>
                                        <div class="form-group">
                                            <h4 id="phase_1_error"></h4>
                                            <button class="btn btn-primary btn-sm" onclick="validatePhase1()">Save</button> &nbsp; 
                                            <?php 
                                                if($uinfo['phase'] >0){
                                                    echo '<button id="nextphase1" class="btn btn-success btn-sm" onclick="nexbtn_phase1()">Next</button>';
                                                }else{
                                                    echo '<button id="nextphase1" class="btn btn-success btn-sm" disabled>Next</button>';
                                                }
                                            ?>  
                                            
                                            
                                        </div>
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        
                        <?php if($uinfo['phase'] > 0){ ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo4">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                                Phase #2 - Educational Details <?php if($uinfo['phase'] == "1"){echo '<span class="label label-info">In Progress</span>';}else{echo '<span class="label label-success">Completed</span>';} ?>
                                </a>
                            </h4>
                            </div>
                            <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo4">
                            <div class="panel-body">
                            <div class="phase1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- phase 1 part 1 --> 
                                            <div class="form-group">
                                                <label>Course Name:<code>*</code> </label>
                                                <input type="text" id="course_name" class="form-control" value="<?php echo $sc['course']; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Course Scheme:<code>*</code> </label>
                                                <select class="form-control" id="scheme" onchange="year()">
                                                    <option value="D">-- Select --</option>
                                                    <option value="Y">Yearly</option>
                                                    <option value="S">Semester</option>
                                                </select>
                                            </div>
                                            <?php 
                                                if($sc['total_phase'] != ""){
                                                    if($sc['course_scheme'] == "S"){
                                                        echo "<p>Last filled Data: </p>";
                                                        echo '<p>Total Semester: '.$sc['total_phase'].'</p>';
                                                        echo '<p>Current Semester: '.$sc['cur_phase'].'</p>';
                                                        echo '<p>Applying Semester: '.$sc['apply_phase'].'</p>';
                                                    }else{
                                                        echo "<p>Last filled Data: </p>";
                                                        echo '<p>Total Year: '.$sc['total_phase'].'</p>';
                                                        echo '<p>Current Year: '.$sc['cur_phase'].'</p>';
                                                        echo '<p>Applying Year: '.$sc['apply_phase'].'</p>';
                                                    }
                                                }
                                            ?>
                                            <div id="year_scheme" class="hide">
                                                <div class="form-group">
                                                    <label>Total No of year:<code>*</code> </label>
                                                    <select class="form-control" id="tot" onchange="loadTotalYear()">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Year applying for:<code>*</code> </label>
                                                    <select class="form-control" id="yapp">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="sem_scheme" class="hide">
                                                <div class="form-group">
                                                        <label>Total No. of Semesters:<code>*</code> </label>
                                                        <select class="form-control" id="tots" onchange="loadTotalSem()">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label>Semester applying for:<code>*</code> </label>
                                                        <select class="form-control" id="sapp">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- phase 1 part 2 --> 
                                            <div class="form-group">
                                                <label>Name of the college:<code>*</code></label>
                                                <input type="text" id="col_name" class="form-control" value="<?php echo $sc['col_name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>College Address:<code>*</code></label>
                                                <textarea id="col_add" class="form-control"><?php echo $sc['col_add']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Pincode:<code>*</code></label>
                                                <input type="text" id="col_pin" class="form-control" value="<?php echo $sc['col_pin']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" id="col_wb" class="form-control" value="<?php echo $sc['col_web']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone No. of the College:<code>*</code></label>
                                                <input type="text" id="col_ph" class="form-control" value="<?php echo $sc['col_phone']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <h3 id="phase_2_error">
                                        
                                    </h3>
                                    <button class="btn btn-sm btn-success" onclick="validatePhase2()">Save</button>
                                    <?php  if($uinfo['phase'] == "1") { ?>
                                    <span id="display_phase_2_btn">
                                        <button class="btn btn-sm btn-info" id="nextphase3" disabled>Next</button>
                                    </span>
                                    <?php } ?>
                                    
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if($uinfo['phase'] > 1){ ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree4">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                Phase #3 - College Bank Details & References <?php if($uinfo['phase'] == "2"){echo '<span class="label label-info">In Progress</span>';}else{echo '<span class="label label-success">Completed</span>';} ?>
                                </a>
                            </h4>
                            </div>
                            <div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree4">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Have you received any other <b>Scholarship</b> or any kind of <b>HELP </b>?<code>*</code></label>
                                            <select class="form-control" id="other_sch" onchange="loadothersch()">
                                                <option value="D">-- Select --</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                        <div id="sch_det" class="hide">
                                            <div class="form-group">
                                                <label>Amount<code>*</code></label>
                                                <input type="text" name="" id="oamt" class="form-control">
                                            </div>
                                             <div class="form-group">
                                                <label>Source<code>*</code></label>
                                                <input type="text" name="" id="osource" class="form-control">
                                            </div>
                                        </div>
                                        <h3>College Bank Account Details</h3>
                                        <hr>
                                        
                                        <div class="form-group">
                                            <label>College Bank Name</label>
                                            <input type="test" id="bname" class="form-control" value="<?php echo $sc['bname']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>College Bank Address</label>
                                            <input type="test" id="badd" class="form-control" value="<?php echo $sc['badd']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>College Bank Account No.</label>
                                            <input type="test" id="bacc" class="form-control" value="<?php echo $sc['bacc']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Bank IFSC Code</label>
                                            <input type="test" id="bifsc" class="form-control" value="<?php echo $sc['bifsc']; ?>"> 
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <h4>Contact Information of Community Leader</h4>
                                        <div class="form-group">
                                            <label>Name<code>*</code></label>
                                            <input type="test" id="cname" class="form-control" value="<?php echo $sc['cname']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Phone<code>*</code></label>
                                            <input type="test" id="cphone" class="form-control" value="<?php echo $sc['cphone']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Address<code>*</code></label>
                                            <input type="test" id="cadd" class="form-control" value="<?php echo $sc['cadd']; ?>"> 
                                        </div>

                                        <h4>Contact information of Teacher</h4>
                                        <div class="form-group">
                                            <label>Name<code>*</code></label>
                                            <input type="test" id="tname" class="form-control" value="<?php echo $sc['tname']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Phone<code>*</code></label>
                                            <input type="test" id="tphone" class="form-control" value="<?php echo $sc['tphone']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Address<code>*</code></label>
                                            <input type="test" id="tadd" class="form-control" value="<?php echo $sc['tadd']; ?>"> 
                                        </div>


                                    </div>
                                </div>
                                <h3 id="phase_3_error"></h3>
                                <button class="btn btn-success btn-sm" onclick="savePhase3()">Save</button>
                                
                                <?php 
                                    if($uinfo['phase'] == "3"){
                                        echo '<button class="btn btn-success btn-sm">Next</button>';
                                    }else{
                                        echo '<button class="btn btn-success btn-sm" disabled>Next</button>';
                                    }
                                ?>
                                
                            </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if($uinfo['phase'] > 2){ ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo5">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion5" href="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo4">
                                Phase #4 - Document Upload <?php if($uinfo['phase'] == "3"){echo '<span class="label label-info">In Progress</span>';}else{echo '<span class="label label-success">Completed</span>';} ?>
                                </a>
                            </h4>
                            </div>
                            <div id="collapseTwo5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo5">
                            <div class="panel-body">
                                    <div id="phase4">
                                        <div class="row">
                                            <form method="post" id="doc" enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bonafied certificate from college <code>*</code></label>
                                                    <input type="file" name="bc_file" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Proof of tution fee from college <code>*</code></label>
                                                    <input type="file" name="tu_fee" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Recent Photograph <code>*</code></label>
                                                    <input type="file" name="re_file" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload Income certificates (Pay slip/Income tax return/Income certificate) <code>*</code></label>
                                                    <input type="file" name="in_file[]" class="form-control" multiple>
                                                </div>
                                                <?php 
                                                    /*if($sc['apply_phase'] > "1"){
                                                        if($sc['course_scheme'] == "S"){
                                                             echo '
                                                                    <div class="form-group">
                                                                        <label>Marksheet of Last Semester</label>
                                                                        <input type="file" name="last_mark" class="form-control">
                                                                    </div>
                                                                ';
                                                        }else{
                                                             echo '
                                                                    <div class="form-group">
                                                                        <label>Marksheet of Last Year</label>
                                                                        <input type="file" name="last_mark" class="form-control">
                                                                    </div>
                                                                ';
                                                        }
                                                    }*/
                                                ?>
                                                
                                                
                                                
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Marksheet of Last Eaxamination (10th standard or12th standard or current course)<code>*</code></label>
                                                    <input type="file" name="last_marks" class="form-control">
                                                </div>
                                                <?php /*<div class="form-group">
                                                    <label>Marksheet of 10<sup>th</sup> standared <code>*</code></label>
                                                    <input type="file" name="ten_file" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Marksheet of 12<sup>th</sup> standared <code>*</code></label>
                                                    <input type="file" name="tw_file" class="form-control">
                                                </div>
                                                */ ?>
                                                <div class="form-group">
                                                    <label>Upload hand written your 'Aim in Life" statement in any language <code>*</code> <!-- <span class="label label-danger">
                                                        <span data-toggle="tooltip" data-placement="top" title="Tell us in brief about you? What has influenced your career path? Your professional interests. Where you plan to see yourself in 10 years from now? Describe your ambitions and goals in life">Guide
                                                    </span> -->
                                                    <span class="label label-danger" style="cursor:pointer;" onclick="guide()">Guide</span>
                                                    <script>
                                                    function guide(){
                                                        document.getElementById("dialog_guide").className="show";
                                                        $( function() {
                                                        $("#dialog_guide").dialog({
                                                            modal: true,
                                                            minWidth: 1000,
                                                            minHeight: 500
                                                        });
                                                      });
                                                    }
                                                    </script>
                                                    <div id="dialog_guide" class="hide" title="Information about -Upload hand written your 'Aim in Life' statement in any language  ">
                                                        <p>Tell us in brief about you? What has influenced your career path? Your professional interests. 
                                                        Where you plan to see yourself in 10 years from now? Describe your ambitions and goals in life</p>
                                                    </div>
                                                    </label>
                                                    <input type="file" name="aim_file" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload copy of certificate(s) or medals you have received in a competition and got 1st/2nd/3rd position <code>Upload Upto 5</code> <span class="label label-info">Optional</span></label>
                                                    <input type="file" name="cm_file[]" class="form-control" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload certificate(s) of your have volunteered in the community <code>Upload Upto 5</code> <span class="label label-info">Optional</span></label>
                                                    <input type="file" name="vo_file[]" class="form-control" multiple>
                                                </div>
                                            </div>
                                            <p align="center"> <input name="sub" type="submit" class="btn btn-success" value="Upload and Submit application"></p>
                                            </form>
                                            
                                            <?php 
                                                if(isset($_POST['sub'])){
                                                    //echo "<pre>";print_r($_FILES);echo "</pre>";
                                                    $script->upload($_FILES,$_SESSION['email']);
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                         <?php } ?>
                        
                    </div>

                <!-- form end  -->
            </div>
          </div>
        </div>



      </div>
    </section>

  </div>
  <script>
      
  </script>
  <!-- end main-content -->
  <!-- Footer -->
  <?php include_once("footer.php"); ?>