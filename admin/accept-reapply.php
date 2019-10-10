<?php 
include_once("script.php");
$script = new script();
if($script->acceptReapply($_GET['uid'])){
    $u = $_GET['u'];
    header("location:view-application.php?uid=$u");
}else{
    echo "<h3>Unknown error occured!</h3>";
}
?>