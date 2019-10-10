<?php 
date_default_timezone_set("Asia/Kolkata");
include_once '../../dexcode/loader.php';
$loader = new loader();

$uid = $_GET['uid'];
$notes = $_GET['note'];
$app = $_GET['app'];
$note = "";
if($app == "1"){
    $col = "sch_status";
    $note = "Your Scholarship application has been rejected. Reason: ".$notes;
}else{
    $col = "ec_status";
    $note = "Your EC application has been rejected. Reason: ".$notes;
}
    $loader->database->update("user",$col."='R'","uid='".$uid."'");
    $loader->database->query("insert into status(uid,status,dt,imp) values('".$uid."','".$note."','".date("d-m-Y")."','d')");
    echo "Application rejected with your Comment.";

?>