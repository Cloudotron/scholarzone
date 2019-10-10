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
                        <!-- table start -->
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Enrollment ID</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Activation Status</th>
                                            <th>Application Form</th>
                                            <th>Date</th>
                                            <th>Scholarship Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $script->getUserList(); ?>
                                    </tbody>
                                </table>
            			  </div>
            			    
                        <!-- table end -->
                    </div>
                </div>
                
                
                
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once("footer.php"); ?>