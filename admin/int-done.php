<?php
if(isset($_GET['uid']) && isset($_GET['form'])){
    include_once  '../dexcode/loader.php';
    $loader = new loader();
    $u = $loader->database->select("user","uid='".$_GET['uid']."'","","","");
    $user = mysqli_fetch_array($u);
    
    $form = "";
    if($_GET['form'] == "1"){
        $form="sch_status";
    }else{
        $form="ec_status";
    }
    
    $up = $loader->database->update("user","$form='INTC'","uid='".$user['uid']."'");
    $up = $loader->database->query("insert into status(uid,status,dt) values('".$user['uid']."','Interview completed!','".date("d-m-Y")."')");
    if($up == true){
        header("location:view-application.php?uid=".$user['uid']);
    }
    
}
?>