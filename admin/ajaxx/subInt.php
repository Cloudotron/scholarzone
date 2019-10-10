<?php 
date_default_timezone_set("Asia/Kolkata");
include_once '../../dexcode/loader.php';
$loader = new loader();

$uid = $_GET['uid'];
$dt = $_GET['dt'];
////id	uid	idt	result	status

$sql = $loader->database->query("select * from interviews where uid='".$uid."'","raw");
//var_dump($sql);
if(mysqli_num_rows($sql)){
    $ar = mysqli_fetch_assoc($sql);
    echo "You already have scheduled interview at: <b>".$ar['idt']."</b>";
}else{
    $loader->database->query("insert into interviews(uid,idt,result,status) values('".$uid."','".$dt."','','')");
    $loader->database->update("user","sch_status='INT'","uid='".$uid."'");
    $loader->database->query("insert into status(uid,status,dt,imp) values('".$uid."','Interview Scheduled at ".$dt."','".date("d-m-Y")."','n')","");
    echo "Interview Scheduled!";
}


?>