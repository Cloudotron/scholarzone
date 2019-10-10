<?php 
    ob_start();
    session_start();
    session_regenerate_id();
    
    include_once '../dexcode/loader.php';
    $loader = new loader();
    $json = file_get_contents('php://input');
    $jd = json_decode($json,true);
    
    /*
        {
                    "course_name":course_name,
                    "scheme":sc,
                    "total":total,
                    "current":current,
                    "applying":applying,
                    "col_name":col_name,
                    "col_ph":col_ph,
                    "col_add":col_add,
                    "col_pin":col_pin,
                    "col_wb":col_wb
                }
    */
    
    function response($st,$mg){
        return json_encode(array("status"=>$st,"msg"=>$mg));
    }
    
    $course = $jd["course_name"];
    $scheme = $jd["scheme"];
    $total = $jd["total"];
    $current = $jd["current"];
    $applying = $jd["applying"];
    $col_name = $jd["col_name"];
    $col_ph = $jd["col_ph"];
    $col_add = $jd["col_add"];
    $col_pin = $jd["col_pin"];
    $col_wb = $jd["col_wb"];
    
    
    //Get the user id
    $sql = $loader->database->select("user","email='".$_SESSION['email']."'","","","");
    $ar = mysqli_fetch_array($sql);
    $uid = $ar['uid'];
    //course,course_scheme,total_phase,cur_phase,apply_phase,col_name,col_add,col_phone,col_pin,col_web

    $up = $loader->database->update("scholarship",
    "course='".$course."',
    course_scheme='".$scheme."',
    total_phase='".$total."',
    cur_phase='".$current."',
    apply_phase='".$applying."',
    col_name='".$col_name."',
    col_add='".$col_add."',
    col_phone='".$col_ph."',
    col_pin='".$col_pin."',
    col_web='".$col_wb."'","uid='".$uid."'");
    
    if($up == true){
        $up = $loader->database->update("user","phase='2'","uid='".$uid."'");
        echo response("true","Your data saved");
    }else{
        echo response("false","Unable to save your data now.");
    }
    
    
    
    
    
?>