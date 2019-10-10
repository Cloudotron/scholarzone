<?php 
date_default_timezone_set("Asia/Kolkata");
include_once 'dexcode/loader.php';
class script extends loader{
    private $load;
    public function __construct(){
      $this->load = new loader();  
    }
    public function test(){
        $this->load->database->debug_connection();
    }
    
    public function uinfo($email){
        $sql = $this->load->database->select("user","email='".$email."'","","","");
        $ar = mysqli_fetch_array($sql);
        return $ar;
    }
    public function StartForm($email,$ftype){
        $sql = $this->load->database->select("user","email='".$email."'","","","");
        $ar = mysqli_fetch_array($sql);
        
        if($ar['uform'] == ""){
            $sql = $this->load->database->update("user","uform='".$ftype."'","email='".$email."'");
            $sql = $this->load->database->update("user","phase='0'","email='".$email."'");
            return true;    
        }else{
            return true;
        }
    }
    
    public function getScholarshipData($em){
        $uia = $this->uinfo($em);
        $uid=$uia['uid'];
        $sql = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        /*
        Array ( [enroll_id] => 6 [uid] => 11 [addr] => BLR [pin] => 560078 [fname] => Manik [foccu] => service 
        [mname] => Sharma [moccu] => service [fincome] => [course] => BCA [course_scheme] => S [total_phase] => 6 
        [cur_phase] => 3 [apply_phase] => 4 [col_name] => MID [col_add] => BLR [col_phone] => 12345 [col_pin] => 560078 
        [col_web] => www.abc.com )
        */
        $ar="";
        if(mysqli_num_rows($sql)>0){
            $ar = mysqli_fetch_assoc($sql);
        }else{
            /*osch,oamt,osource,bname,badd,bacc,bifsc,cname,cadd,cphone,tname,tadd,tphone */
            $ar = array("addr" => "", "pin" => "","fname" => "","foccu" => "","mname" => "","moccu" => "","fincome" =>"", "course" => "",
            "course_scheme" => "","total_phase" => "","cur_phase" => "","apply_phase" => "", "col_name" => "", "col_add" => "", "col_phone" => "",
            "col_pin" => "","col_web" => "","osch"=> "","oamt"=> "","osource"=> "","bname"=> "","badd"=> "","bacc"=> "","bifsc"=> "","cname"=> "","cadd"=> "","cphone"=> "","tname"=> "","tadd"=> "","tphone"=> "");
        }
        return $ar;
    }
    
    public function upload($file,$em){
        
    $uid = $this->uinfo($em)["uid"];
        
    $bf_file = $file['bc_file']['name'];
    $bf_file_tmp = $file['bc_file']['tmp_name'];
    
    $tu_fee = $file['tu_fee']['name'];
    $tu_fee_tmp = $file['tu_fee']['tmp_name'];
                                                    
    $re_file = $file['re_file']['name'];
    $re_file_name = $file['re_file']['tmp_name'];
    
    
    $s = $this->load->database->select("scholarship","uid='".$uid."'","","","");
    $sa = mysqli_fetch_array($s);
    
    
    
    
    
    /*$ten_file = $file['ten_file']['name'];
    $ten_file_tmp = $file['ten_file']['tmp_name'];
    
    $tw_file = $file['tw_file']['name'];
    $tw_file_tmp = $file['tw_file']['tmp_name'];
    */
    $aim_file = $file['aim_file']['name'];
    $aim_file_tmp = $file['aim_file']['tmp_name'];
    
    $cm_file = $file['cm_file']['name']; //multiple
    $cm_file_tmp = $file['cm_file']['tmp_name'];
    
    $vo_file = $file['vo_file']['name']; //multiple
    $vo_file_tmp = $file['vo_file']['tmp_name'];
    
    
    if($bf_file == "" || $tu_fee == "" || $re_file == "" ||  $aim_file == ""){
        echo "<h3 class='alert alert-danger'>All the files are required</h3>";
    }else{
        $type=array("aim_in_life","photo_file","tu_fee","bona_file");
        $name = array($aim_file,$re_file,$tu_fee,$bf_file);
        $tmp = array($aim_file_tmp,$re_file_name,$tu_fee_tmp,$bf_file_tmp);
        $error = 0;
        for($i=0;$i<count($name);$i++){
            $otp = $this->load->security->otp("6");
            $n = $otp.$name[$i];
            if(move_uploaded_file($tmp[$i],"storage/$n")){
                $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','".$type[$i]."','".$n."','".date("d-m-Y")."')");
                $error=1;
            }else{
                $error=0;
            }
        }
        
        if(count($file['cm_file']['name']) > 0){
            for($i=0; $i<count($_FILES['cm_file']['name']); $i++){
                echo "1";
                $n1 = $this->load->security->otp("6").$_FILES['cm_file']['name'][$i];
                    if(move_uploaded_file($_FILES['cm_file']['tmp_name'][$i],"storage/$n1")){
                        $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','cm_file','".$n1."','".date("d-m-Y")."')");
                        $error=1;
                    }else{
                        $error=0;
                    }
            }
        }else{
            $n1 = $this->load->security->otp("6").$_FILES['cm_file']['name'];
            if(move_uploaded_file($_FILES['cm_file']['tmp_name'],"storage/$n1")){
                $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','cm_file','".$n1."','".date("d-m-Y")."')");
                $error=1;
            }else{
                $error=0;
            }
        }
        
        if(count($file['vo_file']['name']) >= 0){
            for($i=0; $i<count($_FILES['vo_file']['name']); $i++){
                echo "2";
                $n2 = $this->load->security->otp("6").$_FILES['vo_file']['name'][$i];
                    if(move_uploaded_file($_FILES['vo_file']['tmp_name'][$i],"storage/$n2")){
                        
                        $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','vo_file','".$n2."','".date("d-m-Y")."')");
                        $error=1;
                    }else{
                        $error=0;
                    }
            }
        }else{
            $n2 = $this->load->security->otp("6").$_FILES['vo_file']['name'];
                    if(move_uploaded_file($_FILES['vo_file']['tmp_name'],"storage/$n2")){
                        
                        $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','vo_file','".$n2."','".date("d-m-Y")."')");
                        $error=1;
                    }else{
                        $error=0;
                    }
        }
        //echo "<pre>";print_r($file);echo "</pre>";
        
        if(isset($file['in_file']['name'])){
            if(count($file['in_file']['name']) > 0){
                for($i=0; $i<count($file['in_file']['name']); $i++){
                    echo "1";
                    $n1 = $this->load->security->otp("6").$file['in_file']['name'][$i];
                        if(move_uploaded_file($file['in_file']['tmp_name'][$i],"storage/$n1")){
                            
                            $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','in_file','".$n1."','".date("d-m-Y")."')");
                            $error=1;
                        }else{
                            $error=0;
                        }
                }
            }else{
                $n1 = $this->load->security->otp("6").$_FILES['in_file']['name'];
                if(move_uploaded_file($file['in_file']['tmp_name'],"storage/$n1")){
                            $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','in_file','".$n1."','".date("d-m-Y")."')");
                            $error=1;
                        }else{
                            $error=0;
                        }
            }
        }
        
        $kb = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        $kbr = mysqli_fetch_array($kb);
        if($kbr['apply_phase'] > "1"){
            //last_mark
            $lm = $this->load->security->otp("6").$file['last_marks']['name'];
            $lmt = $file['last_marks']['tmp_name'];
            if(move_uploaded_file($lmt,"storage/".$lm)){
                $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt) values('".$uid."','last_mark','".$lm."','".date("d-m-Y")."')");
                $error = 1;
            }else{
                $error = 0;
            }
        }
        
        
        
        if($error == 1){
            //update the sch form phase
            $sq1 = $this->load->database->update("user","phase='4'","uid='".$uid."'");
            $sq2 = $this->load->database->update("scholarship","sub_date='".date("d-m-Y")."'","uid='".$uid."'");
            header("location:status.php");
        }else{
            echo "<h3 class='alert alert-danger'>Unable to uplaod all the files. Server problem.</h3>";
        }
        
        
        
    }
}

    public function error($msg){
        return "<h3 class='alert alert-danger'>".$msg."</h3>";
    }
    public function process_ec($p,$f,$uid){
        $add = $p['add'];
        $pin = $p['pin'];
        $fname = $p['fname'];
        $mname = $p['mname'];
        $act = $p['l1'].",".$p['l2'].",".$p['l3'].",".$p['l4'].",".$p['l5'];
        
        
        $bname = $p['bname'];
        $badd = $p['badd'];
        $bacc = $p['bacc'];
        $bifsc = $p['bifsc'];
        
        $sig = $f['sig']['name'];
        $sign = $this->load->security->otp("6").$sig;
        $sig_tmp = $f['sig']['tmp_name'];
        
        $aim = $f['aim']['name'];
        $aimn = $this->load->security->otp("6").$aim;
        $aim_tmp = $f['aim']['tmp_name'];
        
        
        //multipe files
        
        
        
        if($add  == ""){
            echo $this->error("Address is requited");
        }else if($pin == ""){
            echo $this->error("PIN is required");
        }else if($fname == "" || $mname == ""){
            echo $this->error("Father's and Mother's name is required!");
        }else if($act == ",,,"){
            echo $this->error("Award description info is required");
        }else if($bname == "" || $badd == "" || $bacc == "" || $bifsc == ""){
            echo $this->error("All of the bank information is required");
        }else if($sig == "" || $aim == ""){
            echo $this->error("Signature and Aim in life description is mandatory!");
        }else{
            
            if(move_uploaded_file($sig_tmp,"storage/".$sign)){
                    if(move_uploaded_file($aim_tmp,"storage/".$aimn)){
                    $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt,fo) values('".$uid."','ec_sign','".$sign."','".date("d-m-Y")."','ec')");
                    $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt,fo) values('".$uid."','ec_aim','".$aimn."','".date("d-m-Y")."','ec')");
                    
                    if(count($f['ce']['name']) >0){
                        //upload multiple file
                        for($i=0;$i<count($f['ce']['name']);$i++){
                            $nce = $this->load->security->otp("4").$f['ce']['name'][$i];
                            move_uploaded_file($f['ce']['tmp_name'][$i],"storage/".$nce);
                            $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt,fo) values('".$uid."','ec_cert','".$nce."','".date("d-m-Y")."','ec')");
                        }
                        
                    }else{
                        //upload single file
                        $nce = $this->load->security->otp("4").$f['ce']['name'];
                        move_uploaded_file($f['ce']['tmp_name'],"storage/".$nce);
                        $this->load->database->query("insert into doc(uid,doc_type,doc_name,dt,fo) values('".$uid."','ec_cert','".$nce."','".date("d-m-Y")."','ec')");
                    }
                    
                    
                    
                    
                    //data save start
                    $ql = $this->load->database->select("ec_form","uid='".$uid."'","","","");
                        if(mysqli_num_rows($ql)<=0){
                            //upload the docs
                            $this->load->database->query("insert into ec_form(uid,award,authority,addr,pin,fname,mname,bname,baddr,bacc,bifsc,dt) values('".$uid."','".$act."','".$auth."','".$add."','".$pin."','".$fname."','".$mname."','".$bname."','".$badd."','".$bacc."','".$bifsc."','".date("d-m-Y")."')");
                        
                        
                            $this->load->database->update("user","ec_status='C'","uid='".$uid."'");
                            return true;
                        }else{
                            $this->load->database->update("ec_form","
                            award='".$act."',
                            addr='".$add."',
                            pin='".$pin."',
                            fname='".$fname."',
                            mname='".$mname."',
                            bname='".$bname."',
                            baddr='".$badd."',
                            bacc='".$bacc."',
                            bifsc='".$bifsc."',
                            dt='".$dt."'
                            ","uid='".$uid."'");
                            $this->load->database->update("user","ec_status='C'","uid='".$uid."'");
                             return true;
                        }
                       
                    //data save end
                    
                    
                    
                    
                }else{
                    $this->error("Unbale to upload file. Server problem");
                }
            }else{
                $this->error("Unable to upload files. Server Issue!");
            }
            
            
            
        }
        
        
        
    }
    
    public function getSchForm($uid){
        $sql = $this->load->database->select("scholarship","uid='".$uid."'");
        $bs = $this->load->database->select("user","uid='".$uid."'");
        $ar=mysqli_fetch_array($bs);
        $sql=mysqli_fetch_array($sql);
        echo '
            <h3>Basic Information</h3>
            <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                  <th>Entrollment</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Account Status</th>
                    <th>Application Submission Date</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>MF'.$ar['uid'].'</td>
                        <td>'.$ar['fname'].' '.$ar['lname'].'</td>
                        <td>'.$ar['email'].'</td>
                        <td>'.$ar['phone'].'</td>
                        <td>'.$ar['status'].'</td>
                        <td>'.$sql['sub_date'].'</td>
                  </tr>';
        echo '  </tbody>
                </table>
                </div>';
        
        
            echo '
            <h3>Personal Details</h3>
            <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Enrollment No</th>
                    <th>Address</th>
                    <th>Pin</th>
                    <th>Father\'s Name</th>
                    <th>Mother\'s Name</th>
                    <th>Father\'s Occupation</th>
                    <th>Mother\'s Occupation</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>MF'.$sql['uid'].'</td>
                        <td>'.$sql['addr'].'</td>
                        <td>'.$sql['pin'].'</td>
                        <td>'.$sql['fname'].'</td>
                        <td>'.$sql['mname'].'</td>
                        <td>'.$sql['foccu'].'</td>
                        <td>'.$sql['moccu'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
                    
        //educational details
        echo '
        <h3>Educational Details</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Course</th>
                    <th>Scheme</th>
                    <th>Total Year/Sem</th>
                    <th>Current Year/Sem</th>
                    <th>Applying for (year/Sem)</th>
                    <th>College Name</th>
                    <th>College Address</th>
                    <th>College Phone</th>
                    <th>College Pin</th>
                    <th>College Website</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>'.$sql['course'].'</td>
                        <td>'.$sql['course_scheme'].'</td>
                        <td>'.$sql['total_phase'].'</td>
                        <td>'.$sql['cur_phase'].'</td>
                        <td>'.$sql['apply_phase'].'</td>
                        <td>'.$sql['col_name'].'</td>
                        <td>'.$sql['col_add'].'</td>
                        <td>'.$sql['col_phone'].'</td>
                        <td>'.$sql['col_pin'].'</td>
                        <td>'.$sql['col_web'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
        
        //college bank and sch details
        echo '
        <h3>Educational Details</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Other Scholarship</th>
                    <th>Scholarship Source</th>
                    <th>Scholarship Amount</th>
                    <th>Bank Name</th>
                    <th>bank Address</th>
                    <th>Bank Account No</th>
                    <th>Bank IFSC</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>'.$sql['osch'].'</td>
                        <td>'.$sql['osource'].'</td>
                        <td>'.$sql['oamt'].'</td>
                        <td>'.$sql['bname'].'</td>
                        <td>'.$sql['badd'].'</td>
                        <td>'.$sql['bacc'].'</td>
                        <td>'.$sql['bifsc'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
                    
            echo '
        <h3>Community Leader\'s Reference</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>'.$sql['cname'].'</td>
                        <td>'.$sql['cadd'].'</td>
                        <td>'.$sql['cphone'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
            
            echo '
        <h3>Teacher\'s Reference</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>'.$sql['tname'].'</td>
                        <td>'.$sql['tadd'].'</td>
                        <td>'.$sql['tphone'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
        
    }

    //document of scholarship start 
    public function TypeConverter($type){
        switch($type){
            case "aim_in_life":
                return "Aim In Life";
            break;
            case "12_file":
                return "12th Certificate";
            break;
            case "10_file":
                return "1oth Certificate";
            break;
            case "photo_file":
                return "Photograph";
            break;
            case "tu_fee":
                return "Tution Fee";
            break;
            case "bona_file":
                return "Bonafite";
            break;
            case "in_file":
                return "Income Certificate";
            break;
            case "last_mark":
                return "Last Sem/Year Marksheet";
            break;
            case "ec_aim":
                return "EC Aim In Life";
            break;
            case "ec_vo_cert":
                return "EC Volunteering Certificate";
            break;
            case "ec_cert":
                return "EC Achivement Certificate";
            break;
        }
    }
    public function putSchDoc($uid){
        $sql = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type!='cm_file' and doc_type!='vo_file'","raw");
        $ar = array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($ar,$row);
        }
        
        $url = "http://localhost/scholarzonee/";
        
        $sql2 = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type='vo_file' and fo is null","raw");
        $mr = array();
        $vo="";$cm="";
        $c=1;$d=1;
        while($roww = mysqli_fetch_assoc($sql2)){
            if($roww['doc_type'] == "vo_file"){
                $vo .= "<a class='btn btn-sm btn-primary' href='".$url.'storage/'.$roww['doc_name']."'>Volunteering activity - ".$c."</a>,";
                //echo $vo;
                $c++;
            }
        }
        $sql3 = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type='cm_file' and fo is null","raw");
        
        while($roww = mysqli_fetch_assoc($sql3)){
            if($roww['doc_type'] == "cm_file"){
                $cm .= "<a class='btn btn-sm btn-success' href='".$url.'storage/'.$roww['doc_name']."'>achievement - ".$d."</a>,";
                $d++;
            }
        }
        
        $mr['cm']=$cm;$mr['vo']=$vo;
        
        
        
        
        
        //echo "<pre>";var_dump($mr['cm']);echo "</pre>";
        //echo "<pre>";print_r($mr['vo']);echo "</pre>";
        
        if(mysqli_num_rows($sql)){
            echo '<h3>Uploaded Document details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th>Document Link</th>
                            </tr>
                        </thead>
                    ';
                    for($i=0;$i<count($ar);$i++){
                        echo '<tr>';
                            echo '<td>'.$this->TypeConverter($ar[$i]['doc_type']).'</td>';
                            echo '<td><a href="storage/'.$ar[$i]['doc_name'].'" class="btn btn-sm btn-info">Open Document</a></td>';
                        echo '</tr>';
                    }
                    echo '<tr>';
                            echo '<td>Achivement Documents</td>';
                            echo '<td>';
                            $a = explode(",",$mr['cm']);
                            for($j=0;$j<count($a);$j++){
                                echo $a[$j]." ";
                            }
                            echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                            echo '<td>Volunteering activity Documents</td>';
                            echo '<td>';
                            //var_dump($mr['vo']);
                            $a = explode(",",$mr['vo']);
                            for($j=0;$j<count($a);$j++){
                                echo $a[$j]." ";
                            }
                            //var_dump($a);
                            echo '</td>';
                    echo '</tr>';
                    
                    
        echo '      </table>
                </div>';
        }else{
            echo "No Document Found!";
        }
        
    }
    //end
    
    
    public function getECForm($uid){
        
        $sql = $this->load->database->select("ec_form","uid='".$uid."'","","","");
        if(mysqli_num_rows($sql)){
            $sql = mysqli_fetch_assoc($sql);
            echo '
        <h3>EC Appliation Data</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Award</th>
                    <th>Authority</th>
                    <th>Address</th>
                    <th>Pin</th>
                    <th>Father\'s Name</th>
                    <th>Mother\'s Name</th>
                    
                    <th>Bank Name</th>
                    <th>Bank Address</th>
                    <th>Bank Account</th>
                    <th>Bank IFSC</th>
                    <th>Submission Date</th>
                    
                  </tr>
                </thead>
                <tbody>';
            echo '<tr>
                        <td>'.$sql['award'].'</td>
                        <td>'.$sql['authority'].'</td>
                        <td>'.$sql['addr'].'</td>
                        <td>'.$sql['pin'].'</td>
                        <td>'.$sql['fname'].'</td>
                        <td>'.$sql['mname'].'</td>
                        
                        <td>'.$sql['bname'].'</td>
                        <td>'.$sql['baddr'].'</td>
                        <td>'.$sql['bacc'].'</td>
                        <td>'.$sql['bifsc'].'</td>
                        <td>'.$sql['dt'].'</td>
                  </tr>';
            echo '  </tbody>
                    </table>
                    </div>';
        }else{
            echo "<h3>NO Application data found fr EC Form.</h3>";
        }
    }
    public function getECDOCS($uid){
        $sql = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and fo='ec'","raw");
        $sq = mysqli_fetch_assoc($sql);
        if(mysqli_num_rows($sql)){
            echo '
        <h3>EC Appliation Data</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Document type</th>
                    <th>Document link</th>
                    
                  </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_array($sql)){
                    echo '<tr>
                        <td>'.$this->TypeConverter($row['doc_type']).'</td>
                        <td><a target="_blank" href="storage/'.$row['doc_name'].'" class="btn btn-primary btn-sm">Open Document</a></td>
                  </tr>';
                }
                
                
                
        echo '  </tbody>
                    </table>
                    </div>';
        }
        
        
    }
    
    public function getStatus($uid){
        
        
        $sql = $this->load->database->select("status","uid='".$uid."'","","order by sid desc","");
        if(mysqli_num_rows($sql)){
            echo '<br>';
            while($row = mysqli_fetch_assoc($sql)){
                if($row['imp'] == "d"){
                    echo '<p class="alert alert-danger"><b>'.$row['dt'].'</b> - '.$row['status'].'</p>';
                }else if($row['imp'] == "n"){
                    echo '<p class="alert alert-info"><b>'.$row['dt'].'</b> - '.$row['status'].'</p>';
                }else{
                    echo '<p class="alert alert-success"><b>'.$row['dt'].'</b> - '.$row['status'].'</p>';
                }
                
            }
        }
        $a = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        if(mysqli_num_rows($a)){
            $a = mysqli_fetch_assoc($a);
            echo '<p class="alert alert-success"><b>'.$a['sub_date'].'</b> : Scholarship form Submitted</p>';
        }
        $b = $this->load->database->select("ec_form","uid='".$uid."'","","","");
        if(mysqli_num_rows($b)){
            $b = mysqli_fetch_assoc($b);
            echo '<p class="alert alert-success"><b>'.$b['dt'].'</b> : EC form Submitted</p><hr>';
        }
    }
    
    
    
    
    
    public function scholarship_dashboard($uid){
        $sch = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        if(mysqli_num_rows($sch)>0){
            $ar = mysqli_fetch_assoc($sch);
            if($ar['sub_date'] == ""){
                return "<span class='label label-info'>Not Completed</span>";
            }else{
                $s = $this->load->database->select("user","uid='".$uid."'","","","");
                $a = mysqli_fetch_assoc($s);
                $str = "";
                switch($a['sch_status']){
                    case 'INT':
                        $str = "<span class='label label-info'>Interviewing</span>";
                    break;
                    case "A":
                        $str = "<span class='label label-success'>Approved</span>";
                    break;
                    case "R":
                        $str = "<span class='label label-danger'>Rejected</span>";
                    break;
                    case "INTC":
                        $str = "<span class='label label-info'>Interview Done</span>";
                    break;
                    default:
                        $str = "<span class='label label-info'>Completed</span>";
                    break;
                }
                return $str;
            }
        }else{
            return "<span class='label label-info'>Yet to start</span>";
        }
    }
    public function ec_dashboard($uid){
        $sch = $this->load->database->select("ec_form","uid='".$uid."'","","","");
        if(mysqli_num_rows($sch)>0){
            $ar = mysqli_fetch_assoc($sch);
            if($ar['dt'] == ""){
                return "<span class='label label-info'>Not Completed</span>";
            }else{
                $s = $this->load->database->select("user","uid='".$uid."'","","","");
                $a = mysqli_fetch_assoc($s);
                $str = "";
                switch($a['ec_status']){
                    case "A":
                        $str = "<span class='label label-success'>Approved</span>";
                    break;
                    case "R":
                        $str = "<span class='label label-danger'>Rejected</span>";
                    break;
                }
                return $str;
            }
        }else{
            return "<span class='label label-info'>Yet to start</span>";
        }
    }
    
    public function getSchDate($uid){
        $sql = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        if($sql){
            return mysqli_fetch_assoc($sql);
        }else{
            return array("sub_date"=>"");
        }
    }
    public function checktran($uid){
        $sql = $this->load->database->select("status","uid='".$uid."' and tp='T'","","","");
        if(mysqli_num_rows($sql)){
            return true;
        }else{
            return false;
        }
    }
    public function processReceipt($fname,$tfname,$uid){
        $n = $this->load->security->otp("6").$fname;
        $q = $this->load->database->select("receipt","uid='".$uid."'","","","");
        $r = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        $ar = mysqli_fetch_array($r);
        $sem = $ar['cur_phase'];
        if(mysqli_num_rows($q)){
            echo "<h4>You already uploaded receipt for this session.</h4>";
        }else{
            if(move_uploaded_file($tfname,"storage/".$n)){
                $ql = $this->load->database->query("insert into receipt(uid,fname,sem,dt) values('".$uid."','".$n."','".$sem."','".date("d-m-Y")."')","");
                if($ql){
                    return true;
                }else{
                    return false;
                }
            }else{
                echo "Failed to upload your receipt";
            }
        }
        
    }
    public function getReceipt($uid){
        $url = "http://localhost/scholarzonee/";
        
        $sql = $this->load->database->select("receipt","uid='".$uid."'","","","");
        
        $r = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        $ar = mysqli_fetch_array($r);
        
        
        if(mysqli_num_rows($sql)){
            echo '
        <h3>Receipt Data</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Receipt Date</th>';
                    if($ar['course_scheme'] == "S"){
                        echo '<th>Semester</th>';
                    }else{
                        echo '<th>Year</th>';
                    }
                    echo '<th>Receipt link</th>
                    
                  </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_array($sql)){
                    echo '<tr>
                        <td>'.$row['dt'].'</td>
                        <td>'.$row['sem'].'</td>
                        <td><a target="_blank" href="'.$url.'storage/'.$row['fname'].'" class="btn btn-primary btn-sm">Open Document</a></td>
                        
                  </tr>';
                }
                
                
                
        echo '  </tbody>
                    </table>
                    </div>';
        }
    }
    public function reapply($uid,$filename,$filetmp,$sem){
        $sq = $this->load->database->select("reapply","uid='".$uid."' and sem='".$sem."'","","","");
        if(mysqli_num_rows($sq) >0){
            echo "<h3>Already reapplied</h3>";
        }else{
            $f = $this->load->security->otp("6").$filename;
            if(move_uploaded_file($filetmp,"storage/".$f)){
                $sql = $this->load->database->insert("reapply","uid,mcard,sem,dt,status","'".$uid."','".$f."','".$sem."','".date("d-m-Y")."','P'");
                if($sql){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    public function getMarks($em){
        $rr = $this->load->database->select("user","email='".$em."'","","","");
        $rt = mysqli_fetch_array($rr);
        $uid = $rt['uid'];
        $r = $this->load->database->select("scholarship","uid='".$uid."'","","","");
        $y = mysqli_fetch_array($r);
        $arr = array("ten"=>$y['ten_per'],"tw"=>$y['tw_per'],"grad"=>$y['grad_per']);
        return $arr;
    }

}
//$script = new script();
?>