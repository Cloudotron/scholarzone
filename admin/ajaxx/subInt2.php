<?php 
date_default_timezone_set("Asia/Kolkata");
include_once '../../dexcode/loader.php';
$loader = new loader();

$uid = $_GET['uid'];
$dt = $_GET['dt'];
////id	uid	idt	result	status

    $loader->database->update("interviews","idt='".$dt."'","uid='".$uid."'");
    
    $loader->database->update("user","sch_status='INT'","uid='".$uid."'");
    
    $loader->database->query("insert into status(uid,status,dt,imp) values('".$uid."','Interview Re-scheduled at ".$dt."','".date("d-m-Y")."','n')","");
    
    echo "Interview Rescheduled!";

?>