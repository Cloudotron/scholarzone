<?php include_once("header.php"); 
include_once("script.php");
$script = new script;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Re-apply rejection</h1>
          
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <!-- table start -->
                            <form method="post">
                                <div class="form-group">
                                    <label>Your comment about rejection</label>
                                    <textarea class="form-control" name="rcom"></textarea>
                                </div>
                                <div>
                                    <input type="submit" name="sub" class="btn-block btn btn-primary" value="Reject">
                                </div>
                            </form>
                            <?php 
                            if(isset($_POST['sub'])){
                                if(!isset($_GET['uid']) || $_GET['uid'] == ""){
                                    echo "<h3>No user id initiated</h3>";
                                }else{
                                    $rid = $_GET['uid'];
                                    $com = $_POST['rcom'];
                                    if($script->rejectReapply($rid,$com)){
                                        echo "<h3>Rejected with notification</h3>";
                                    }else{
                                        echo "<h3>Falied to Rejected</h3>";
                                    }
                                }
                            }
                            ?>
                        <!-- table end -->
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once("footer.php"); ?>