<?php 
    ob_start();
    session_start();
    session_regenerate_id();
    
    include_once '../dexcode/loader.php';
    $loader = new loader();
    $json = file_get_contents('php://input');
    $jd = json_decode($json,true);
    
    function response($ar){
        return json_encode($ar);
    }
    
    
    $sql = $loader->database->select("user","email='".$_SESSION['email']."'","","","");
    $ar = mysqli_fetch_array($sql);
    $uid = $ar['uid'];
    
    //get phase 1 data
    ////uid	addr	pin	fname	foccu	mname	moccu
    
    $ck = $loader->database->select("scholarship","uid='".$uid."'","","","");
    if(mysqli_num_rows($ck)){
        $sq = mysqli_fetch_assoc($ck);
        echo response($sq);
    }else{
        echo response(array());
    }
    
    
    
?>