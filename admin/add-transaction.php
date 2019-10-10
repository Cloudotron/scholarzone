<?php include_once("header.php"); 
include_once("script.php");
$script = new script;
$u = $script->userInfo($_GET['uid']);
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Transaction for <b><?php echo $u['fname']." ".$u['lname']; ?> (MF<?php echo $u['uid'] ?>)</b> </h1>
          
          <div class="row">
            <div class="col-md-4">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Enrollment ID</label>
                                <input type="text" class="form-control" value="MF<?php echo $u['uid'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="<?php echo $u['fname']." ".$u['lname']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Transaction Date</label>
                                <script>
                                  $( function() {
                                    $( "#datepicker" ).datepicker({
                                        changeYear: true,
                                        changeMonth: true
                                    });
                                  } );
                                </script>
                                <input type="text" id="datepicker" class="form-control" name="tdt">
                            </div>
                            <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control" name="type">
                                    <option value="btc">Transferred to the bank account of the college</option>
                                    <option value="cqc">Cheque is mailed to the college</option>
                                    <option value="btp">Transferred to your bank account</option>
                                    <option value="cqp">Check is mailed to you.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Transaction Amount</label>
                                
                                <input type="text" class="form-control"  name="tamt">
                            </div>
                            <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control" name="ttype">
                                    <option value="sch">Scholarship Form</option>
                                    <option value="ec">EC Form</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Transaction Receipt</label>
                                <input type="file" class="form-control" name="tfile">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="sub" class="btn btn-success btn-block">
                            </div>
                        </form>
                        <?php 
                            if(isset($_POST['sub'])){
                                $tdt = $_POST['tdt'];
                                $tamt = $_POST['tamt'];
                                $type = $_POST['type'];
                                $ttype = $_POST['ttype'];
                                $tp="";
                                switch($type){
                                    case "btc":
                                        $tp="Congratulations! You have been awarded the amount of ₹ ".$tamt." for your tuition fees. <br><br> The amount has been disbursed via: <b>Transferred to the bank account of the college</b> on ".$tdt."  <br><br> Please make sure that the college has credited to you. Once it is confirmed <b>please obtain the receipt of the payment</b> from the college and Upload the copy of receipt in \'Upload Receipt\' tab.";
                                        break;
                                    case "cqc":
                                        $tp="Congratulations! You have been awarded the amount of ₹ ".$tamt." for your tuition fees. <br><br> The amount has been disbursed via: <b>Cheque is mailed to the college</b> on ".$tdt." <br><br> Please make sure that the college has credited to you. Once it is confirmed <b>please obtain the receipt of the payment</b> from the college and Upload the copy of receipt in \'Upload Receipt\' tab. Please find the transaction receipt here";
                                        break;
                                    case "btp":
                                        $tp="Congratulations! You have been awarded the amount of ₹ ".$tamt." for your tuition fees. <br><br> The amount has been disbursed via: <b>Transferred to your bank account</b> on ".$tdt." <br><br> Please deposit the amount to your college. <b>Please obtain the receipt of the payment</b> from the college and Upload the copy of receipt in \'Upload Receipt\' tab. Please find the transaction receipt here";
                                        break;
                                    case "cqp":
                                        $tp="Congratulations! You have been awarded the amount of ₹ ".$tamt." for your tuition fees. <br><br> The amount has been disbursed via: <b>Check is mailed to you</b> on ".$tdt." <br><br> Please deposit the amount to your college. <b>Please obtain the receipt of the payment</b> from the college and Upload the receipt in \'Upload Receipt\' tab. Please find the transaction receipt here";
                                        break;
                                    
                                }
                                $tt = "";
                                switch($ttype){
                                    case "sch":
                                        $tt="Scholarship Form";
                                        break;
                                    case "ec":
                                        $tt="EC Form";
                                        break;
                                }
                                $msg = $tp;
                                //echo $msg;
                                $uid = $_GET['uid'];
                                $sc = $script->addTransaction($uid,$msg,$_FILES);
                                if($sc){
                                    echo "<h4>Transaction added!</h4>";
                                }else{
                                    echo "<h4>Failed to add transaction!</h4>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <!-- table start -->
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Enrollment ID</th>
                                            <th>Transaction</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $script->getTransaction($_GET['uid']); ?>
                                    </tbody>
                                </table>
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