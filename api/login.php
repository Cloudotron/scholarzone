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
    
    $email = $jd['email'];
    $pass = $jd['pass'];
    
    $sql = $loader->database->select("user","email='".$email."'","","","");
    if(mysqli_num_rows($sql)>0){
        $ar = mysqli_fetch_array($sql);
        $dp = $loader->security->decrypt($ar['pass']);
        if($dp == $pass){
            $_SESSION['email']=$email;
            echo response("true","Login validated!");
        }else{
            echo response("false","Invalid login");
        }
    }else{
        echo response("false","Invalid login information provided!");
    }
    
    
    
    
?>