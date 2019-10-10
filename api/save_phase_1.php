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
    
    
    $add = $jd["address"];
    $pin = $jd["pin"];
    $fname = $jd["fname"];
    $foccu = $jd["foocu"];
    $mname = $jd["mname"];
    $moccu = $jd["moccu"];
    $fincome = $jd["fincome"];
    
    $sql = $loader->database->select("user","email='".$_SESSION['email']."'","","","");
    $ar = mysqli_fetch_array($sql);
    $uid = $ar['uid'];
    
    $sq = $loader->database->select("scholarship","uid='".$uid."'","","","");
    $no = mysqli_num_rows($sq);
    
    if($no != 0){
        //already there, just update the fields
        //echo "init\n";
        $up = $loader->database->update("scholarship",
        "addr='".$add."',pin='".$pin."',fname='".$fname."',foccu='".$foccu."',mname='".$mname."',moccu='".$moccu."',fincome='".$fincome."'",
        "uid='".$uid."'");
        
        if($up == true){
            $loader->database->update("user","phase='1'","uid='".$uid."'");
            //echo "phase updated";
            echo response("true","Your data updated!");
        }else{
            echo response("false","failed to update the data. Try later!");
        }
        
    }else{
        //insert the new row
        
        $in = $loader->database->query("insert into scholarship(uid,addr,pin,fname,foccu,mname,moccu) 
        values('".$uid."','".$add."','".$pin."','".$fname."','".$foccu."','".$mname."','".$moccu."')");
        if($in == true){
            $up = $loader->database->update("user","phase='1'","uid='".$uid."'");
            echo response("true","Your data added!");
        }else{
            echo response("false","Failed to create record for you. Try later.");
        }
    }
    
    
    
    
?>