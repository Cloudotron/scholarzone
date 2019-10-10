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
            <p><i>Enrollment No.: MF<?php echo $uinfo['uid']; ?> | Email: <?php echo $uinfo['email']; ?></i></p>
        </div>
    </div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div id="myValues"></div>
        <script type="text/javascript">
            $("#myValues").myfunc({divFact:10,gagueLabel:'%',maxVal: 100,eventListenerType:'change'});
            var v = "<?php 
                $ar = $script->getMarks($$_SESSION['email']);
                $x10th = $ar['ten'];
                $x12th = $ar['tw'];
                $degree = $ar['grad'];
                
                //echo "10th :".$x10th."<br>";
                //echo "12th :".$x12th."<br>"; 
                //echo "Degree :".$degree."<br>";
                
                echo exec("\"C:\Program Files\R\R-3.6.1\bin\Rscript.exe\" Prediction.R $x10th $x12th $degree");
                
            ?>";
            $("#myValues").val(v);
            $("#myValues").trigger("change");
        </script>
    </div>
    </div>
    <div class="col-md-2"></div>
</div>

<br>


<?php 
include_once("footer.php");
?>