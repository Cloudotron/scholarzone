<?php 
    include_once("header.php");
    include_once("menu.php"); 
    if(!isset($_SESSION['email']) || $_SESSION['email'] == "" || $_SESSION['email'] == " "){
        header("location:logout.php");
    }
    include_once("script.php");
    $script = new script;
    $uinfo=$script->uinfo($_SESSION['email']);
    $s=0;
    if($uinfo['sch_status'] != "C"){
        $s=1;
        $sc = $script->getScholarshipData($_SESSION['email']);
    }
    if($uinfo['ec_status'] == "A" || $uinfo['ec_status'] == "C"){
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
              <h2 class="title text-uppercase mb-5">Extra Curricular Achievements <span class="text-theme-colored2">form</span> (EC Form)</h2>
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
                $( "#dialog" ).dialog({
                    modal: true,
                    minWidth: 1000,
                    minHeight: 500
                });
              } );
              
            
              </script>
            <div id="dialog" title="INSTRUCTION FOR THE ‘EXTRA CURRICULAR ACHIVEMENT RECOGNITION’ APPLICATION">
                <p>1.	Some of the information are <b>mandatory/compulsory</b> which are depicted by <code>*</code> which you must fill in.
<br>2.	Fill your personal information.
<br>3.	List the activities
<br>4.	Provide your Bank information. Make sure everything is correct. The award will be transferred to this bank by wire transfer only. when we will transfer the money, you will be notified by <b>email</b> (i.e. your ID) and by <b>Notification</b>.
<br>5.	You must <b>Upload all the required documents</b>. You will be able to upload the documents in any image format (JPG, JPEG, PNG). DO NOT use PDF file.
<br>6.	Upload your <b>Hand Written</b> ‘Aim of the life’ statement in any image format. Click the <span class="label label-danger">Guide</span>. Guide will inform you what to include in the statement.
<br>7.	Once you have provided all the information then click on the <b>‘Submit’</b> to submit the application. 
<br><br>Once you have successfully submitted the application you will receive an email (i.e. your ID) stating ‘You have successfully submitted the application and it is under review”.
<br><br>Macwan Foundation will schedule a <b>Phone call</b> and you will receive an <b>Email and Notification</b> of the date.
<br<br>>Check on the website periodically to check the status of your application. To look up the status you must sign in on your account using your ID (i.e. Email address) and Password.
<br><br>If have any questions email us at info@macwanfoundation.org

                </p>
              <p><kbd>By closing this window you accept that you have understood all the instructions given and ready to fillup the form accordingly.</kbd></p>
            </div>
            
            
            
          <div class="row">
              <form method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" name="n" class="form-control" disabled value="<?php echo $uinfo['fname'].' '.$uinfo['lname']; ?>">
                            <input type="hidden" name="name" class="form-control" value="<?php echo $uinfo['fname'].' '.$uinfo['lname']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email: </label>
                            <input type="text" disabled name="e" class="form-control" value="<?php echo $uinfo['email']; ?>">
                            <input type="hidden" name="email" class="form-control" value="<?php echo $uinfo['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact: </label>
                            <input type="text" disabled name="c" class="form-control" value="<?php echo $uinfo['phone']; ?>">
                            <input type="hidden" name="con" class="form-control" value="<?php echo $uinfo['phone']; ?>">
                        </div>
                        
                        
                        <div class="form-group">
                            <label>Address: </label>
                            <textarea class="form-control" name="add" ><?php if($s==1){echo $sc['addr'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pin code: </label>
                            <input type="text" name="pin" class="form-control" value="<?php if($s==1){echo $sc['pin'];} ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Father's Name:<code>*</code> </label>
                                    <input type="text" name="fname" class="form-control" value="<?php if($s==1){echo $sc['fname'];} ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mother's Name:<code>*</code> </label>
                                    <input type="text" name="mname" class="form-control" value="<?php if($s==1){echo $sc['mname'];} ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>List of Activities: <code>*</code> </label><br>
                            <label>Activity 1</label><input type="text" class="form-control" name="l1"><br>
                            <label>Activity 2</label><input type="text" class="form-control" name="l2"><br>
                            <label>Activity 3</label><input type="text" class="form-control" name="l3"><br>
                            <label>Activity 4</label><input type="text" class="form-control" name="l4"><br>
                            <label>Activity 5</label><input type="text" class="form-control" name="l5"><br>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        
                        <h3>Personal Bank Information</h3>
                        <hr>
                        <div class="form-group">
                            <label>Bank Name:<code>*</code> </label>
                            <input type="text" name="bname" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank Address:<code>*</code> </label>
                            <input type="text" name="badd" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank Account No:<code>*</code> </label>
                            <input type="text" name="bacc" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank IFSC:<code>*</code> </label>
                            <input type="text" name="bifsc" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Signature:<code>*</code> </label>
                            <input type="file" name="sig" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Upload copy of certificate or medals you have received in a competition and got 1st/2nd/3rd position <code>Max 5 Documents</code>: </label>
                            <input type="file" name="ce[]"  class="form-control" multiple>
                        </div>
                        <div class="form-group">
                            <label>Upload hand written your 'Aim in Life" statement in any language <code>*</code> <span class="label label-danger"><span data-toggle="tooltip" data-placement="top" title="Tell us in brief about you? What has influenced your career path? Your professional interests. Where you plan to see yourself in 10 years from now? Describe your ambitions and goals in life">Guide</span></label>
                            <input type="file" name="aim" class="form-control">
                        </div>
                        <div class="form-group">
                            <div style="height: 100px;overflow-y: scroll; border:1px solid #000;padding:10px">
                                By Clicking "Submit", I hereby certify that all the information in this application is accurate and complete. I hereby give Macwan Foundation permission to share my name if I am selected as the recipient. I acknowledge that Macwan Foundation’s directors have the final and exclusive authority to in the selection of recipient(s). Macwan Foundation reserves the right to interpret and review the terms, conditions and procedures of the program and to make changes at any time, including termination of the program. By applying, applicants agree that Macwan Foundation will have no liability for any of its acts or omissions in operating the program. The number of recipients awarded each year varies and is determined in the sole discretion of Macwan Foundation.   
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-primary btn-block" name="sub" value="Submit">
                        </div>
                    </div>
                </div>
                
            </div>
            </form>
            
            <?php 
                if(isset($_POST['sub'])){
                    
                    if($script->process_ec($_POST,$_FILES,$uinfo['uid'])){
                        header("location:status.php");
                    }else{
                        echo "Unable to complete the form";
                    }
                    
                }
            ?>
            
          </div>
          
          
          
          
        </div>



      </div>
    </section>

  </div>
  
  <!-- end main-content -->
  <!-- Footer -->
  <?php include_once("footer.php"); ?>