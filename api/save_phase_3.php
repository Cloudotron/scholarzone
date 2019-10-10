<?php 
    ob_start();
    session_start();
    session_regenerate_id();
    
    include_once '../dexcode/loader.php';
    $loader = new loader();
    $json = file_get_contents('php://input');
    $jd = json_decode($json,true);
    
    function response($st,$mg){
        return json_encode(array("status"=>$st,"msg"=>$mg));
    }

    $osch = $jd["osch"];
    $osource = $jd["osource"];
    $oamt = $jd["oamt"];
    
    $bacc = $jd["bacc"];
    $bname = $jd["bname"];
    $badd = $jd["badd"];
    $bifsc = $jd["bifsc"];
    
    $cname = $jd["cname"];
    $cadd = $jd["cadd"];
    $cphone = $jd["cphone"];
    
    $tname = $jd["tname"];
    $tadd = $jd["tadd"];
    $tphone = $jd["tphone"];
    
    //Get the user id
    $sql = $loader->database->select("user","email='".$_SESSION['email']."'","","","");
    $ar = mysqli_fetch_array($sql);
    $uid = $ar['uid'];
    
    $up = $loader->database->update("scholarship",
    "osch='".$osch."',
    oamt='".$oamt."',
    osource='".$osource."',
    bname='".$bname."',
    badd='".$badd."',
    bacc='".$bacc."',
    bifsc='".$bifsc."',
    cname='".$cname."',
    cadd='".$cadd."',
    cphone='".$cphone."',
    tname='".$tname."',
    tadd='".$tadd."',
    tphone='".$tphone."'","uid='".$uid."'");
    
    if($up == true){
        $up = $loader->database->update("user","phase='3'","uid='".$uid."'");
        echo response("true","Your data saved");
    }else{
        echo response("false","Unable to save your data now.");
    }
    
    
?>