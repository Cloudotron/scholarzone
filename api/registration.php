<?php 
    include_once '../dexcode/loader.php';
    $loader = new loader();
    $json = file_get_contents('php://input');
    $jd = json_decode($json,true);
    
    function response($st,$mg){
        return json_encode(array("status"=>$st,"msg"=>$mg));
    }
    
    $fname = $jd['fname'];
    $lname = $jd['lname'];
    $email = $jd['email'];
    $pass = $jd['pass'];
    $gen = $jd['gen'];
    $phone = $jd['phone'];
    //print_r($jd);
    //die();
    
    $sql = $loader->database->select("user","email='".$email."' or phone='".$phone."'","","","");
    if(mysqli_num_rows($sql)>0){
        echo response("false","You are already with us. Please Login to your account <br> Your <b>Phone number</b> or <b>Email</b> is already registered with us");
    }else{
        $ep = $loader->security->encrypt($pass);
        $otp = $loader->security->otp("6");
        $sql=$loader->database->insert("user","fname,lname,email,phone,pass,status,token,reg_dt","'".$fname."','".$lname."','".$email."','".$phone."','".$ep."','I','".$otp."','".date("d-m-Y")."'");
        if($sql){
            echo response("true","Registration completed. You can login now.");
        }else{
            echo response("false","Failed to register now. Try later.");
        }
    }
    
    
    
    
?>