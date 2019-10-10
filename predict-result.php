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
            <p>Prediction about getting a scholarship</p>
        </div>
    </div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3 align="center">Based on your marks we are predicting the probability of getting a scholarship in ScholarZone</h3>
        
    </div>
    </div>
    <div class="col-md-2"></div>
</div>

<br>


<?php 
include_once("footer.php");
?>