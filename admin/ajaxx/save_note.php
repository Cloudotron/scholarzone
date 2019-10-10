<?php 
date_default_timezone_set("Asia/Kolkata");
include_once '../../dexcode/loader.php';
$loader = new loader();

$uid = $_GET['uid'];
$notes = $_GET['notes'];

    $loader->database->query("insert into notes(uid,note,dt) values('".$uid."','".$notes."','".date("d-m-Y")."')");
    echo "Notes added for this user.!";

?>