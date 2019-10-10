<?php
date_default_timezone_set("Asia/Kolkata");
include_once '../dexcode/loader.php';
class script extends loader{
    private $load;
    public function __construct(){
        $this->load = new loader();
    }
    
    public function login($email,$pass){
        if($email == "admin@admin.com"){
            if($pass == "12345"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function getTotalRegistration(){
        //var_dump($this->load);
        $sql = $this->load->database->select("user","","","","");
        $ar = mysqli_num_rows($sql);
        return $ar;
    }
    public function getCom(){
        //$sql = $this->load->database->select("scholarship","sub_date!=''","","","");
        $sql = $this->load->database->select("user","sch_status=''","","","");
        return mysqli_num_rows($sql);
    }
    public function getEcrev(){
        $sql = $this->load->database->select("user","ec_status='C'","","","");
        return mysqli_num_rows($sql);
    }
    public function getInc(){
        $sql = $this->load->database->select("scholarship","sub_date=''","","","");
        return mysqli_num_rows($sql);
    }
    public function getInv(){
        $sql = $this->load->database->select("interviews","","","","");
        return mysqli_num_rows($sql);
    }
    public function getAccS(){
        $sql = $this->load->database->select("user","sch_status='A'","","","");
        return mysqli_num_rows($sql);
    }
    public function getAccE(){
        $sql = $this->load->database->select("user","ec_status='A'","","","");
        return mysqli_num_rows($sql);
    }
    public function getRejS(){
        $sql = $this->load->database->select("user","sch_status='R'","","","");
        return mysqli_num_rows($sql);
    }
    public function getRejE(){
        $sql = $this->load->database->select("user","ec_status='R'","","","");
        return mysqli_num_rows($sql);
    }
    public function getIntr(){
        //$sql = $this->load->database->query("SELECT * FROM `status` WHERE status like 'Interview Re-scheduled%'","raw");
        $sql = $this->load->database->query("SELECT * FROM `status` WHERE status like 'Interview Scheduled%'","raw");
        
        return mysqli_num_rows($sql);
    }
    public function getIntDone(){
        $sql = $this->load->database->select("user","sch_status='INTC'","","","");
        return mysqli_num_rows($sql);
    }
    
    
    public function getTotalActivated(){
        //var_dump($this->load);
        $sql = $this->load->database->select("user","status='A'","","","");
        $ar = mysqli_num_rows($sql);
        return $ar;
    }
    public function getUserList(){
        $sql = $this->load->database->select("user","","","","");
        if(mysqli_num_rows($sql) >0){
            while($row = mysqli_fetch_assoc($sql)){
                echo '<tr>';
                    echo '<td>MF'.$row['uid'].'</td>';
                    echo '<td>'.$row['fname'].' '.$row['lname'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['phone'].'</td>';
                    echo '<td>';
                    if($row['status'] == "I"){
                        echo "Inactive";
                    }else{
                        echo "Active";
                    }
                    echo '</td>';
                    
                    echo '<td>';
                    if($row['uform'] == "1"){
                        echo "Scholarship Form";
                    }else{
                        $s = $this->load->database->select("ec_form","uid='".$row['uid']."'","","","");
                        if(mysqli_num_rows($s)){
                            echo "EC Form";
                        }else{
                            echo "Yet to select";
                        }
                    }
                    
                    
                    echo '</td>';
                    echo '<td>'.$row['reg_dt'].'</td>';
                    echo "<td>";
                        $ss = $this->load->database->select("scholarship","uid='".$row['uid']."'","","","");
                        if(mysqli_num_rows($ss)){
                            $zr = mysqli_fetch_assoc($ss);
                            if($zr['sub_date'] != ""){
                                if($row['sch_status'] != "" || $row['sch_status'] != " "){
                                    switch($row['sch_status']){
                                        case "A":
                                            echo "Approved";
                                            break;
                                        case "R":
                                            echo "Rejected";
                                            break;
                                        case "INT":
                                            echo "Interview Scheduled";
                                            break;
                                        case "INTC":
                                            echo "Interview Done";
                                            break;
                                    }
                                }else{
                                    echo "<span class='label label-success'>Completed!</span>";
                                }
                            }else{
                                echo "<span class='label label-info'>Not Completed!</span>";
                            }
                        }
                        
                    echo "</td>";
                    
                    echo "<td>";
                        $sp = $this->load->database->select("ec_form","uid='".$row['uid']."'","","","");
                        if(mysqli_num_rows($sp)){
                            
                            switch($row['ec_status']){
                                case "C":
                                    echo "Completed!";
                                    break;
                                case "A":
                                    echo "Approved";
                                    break;
                                case "R":
                                    echo "Rejected";
                                    break;
                            }
                        }else{
                            echo "Yet to start";
                        }
                        
                    echo "</td>";
                    
                    
                    echo '<td>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        <a href="view-application.php?uid='.$row['uid'].'" class="btn btn-sm btn-primary" target="_blank">View App<sup>tn</sup></a>
                        <a href="add-transaction.php?uid='.$row['uid'].'" class="btn btn-warning btn-sm">Transaction</a>
                    </td>';
                    
                echo '</tr>';
            }
        }else{
            echo "<h3>No registered user found!</h3>";
        }
    }
    
    public function putScholarship($uid,$ar){
        $ar = mysqli_fetch_array($ar);
        //put personal info
        $sql = $this->load->database->select("user","uid='".$uid."'","","","");
        echo '<h3>Basic Details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Enrollment ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Email Activation Status</th>
                                <th>Form</th>
                                <th>Date of Joining</th>
                                <th>Submission Date</th>
                            </tr>
                        </thead>
                    ';
                    while($row = mysqli_fetch_assoc($sql)){
                        echo '<tr>';
                            echo '<td>MF'.$row['uid'].'</td>';
                            echo '<td>'.$row['fname'].' '.$row['lname'].'</td>';
                            echo '<td>'.$row['email'].'</td>';
                            echo '<td>'.$row['phone'].'</td>';
                            echo '<td>';
                            if($row['status'] == "I"){
                                echo "Inactive";
                            }else{
                                echo "Active";
                            }
                            echo '</td>';
                            echo '<td>';
                            if($row['uform'] == "1"){
                                echo "Scholarship";
                            }else if($row['uform'] == "2"){
                                echo "EC Form";
                            }else{
                                echo "Yet to select";
                            }
                            echo '</td>';
                            echo '<td>'.$row['reg_dt'].'</td>';
                            echo '<td>'.$ar['sub_date'].'</td>';
                            
                        echo '</tr>';
                    }
        echo '      </table>
                </div>';
        //put personal info
        echo '<h3>Personal Details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Pin</th>
                                <th>Father\'s Name</th>
                                <th>Father\'s Occupation</th>
                                <th>Mother\'s Name</th>
                                <th>Mother\'s Occupation</th>
                            </tr>
                        </thead>
                    ';
                        echo '<tr>';
                            echo '<td>'.$ar['addr'].'</td>';
                            echo '<td>'.$ar['pin'].'</td>';
                            echo '<td>'.$ar['fname'].'</td>';
                            echo '<td>'.$ar['foccu'].'</td>';
                            echo '<td>'.$ar['mname'].'</td>';
                            echo '<td>'.$ar['moccu'].'</td>';
                        echo '</tr>';
        echo '      </table>
                </div>';
        
        //put educational
        echo '<h3>Educational Details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Course Scheme</th>
                                <th>Total Duration</th>
                                <th>Current (sem/year)</th>
                                <th>Applying (sem/year)</th>
                                <th>College Name</th>
                                <th>College Address</th>
                                <th>College Pin</th>
                                <th>College Contact</th>
                                <th>College Website</th>
                            </tr>
                        </thead>
                    ';
                    echo '<tr>';
                            echo '<td>'.$ar['course'].'</td>';
                            echo '<td>'.$ar['course_scheme'].'</td>';
                            echo '<td>'.$ar['total_phase'].'</td>';
                            echo '<td>'.$ar['cur_phase'].'</td>';
                            echo '<td>'.$ar['apply_phase'].'</td>';
                            echo '<td>'.$ar['col_name'].'</td>';
                            echo '<td>'.$ar['col_add'].'</td>';
                            echo '<td>'.$ar['col_pin'].'</td>';
                            echo '<td>'.$ar['col_phone'].'</td>';
                            echo '<td>'.$ar['col_web'].'</td>';
                        echo '</tr>';
        echo '      </table>
                </div>';
        
        
        
        //put Scholarship and college bank details
        echo '<h3>Other Scholarship and Bank Details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Other Scholarship</th>
                                <th>Scholarship Amount</th>
                                <th>Scholarship Source</th>
                                <th>College Bank Name</th>
                                <th>college Bank Address</th>
                                <th>College Bank Account</th>
                                <th>College Bank IFSC</th>
                            </tr>
                        </thead>
                    ';
                    echo '<tr>';
                            echo '<td>'.$ar['osch'].'</td>';
                            echo '<td>'.$ar['oamt'].'</td>';
                            echo '<td>'.$ar['osource'].'</td>';
                            echo '<td>'.$ar['bname'].'</td>';
                            echo '<td>'.$ar['badd'].'</td>';
                            echo '<td>'.$ar['bacc'].'</td>';
                            echo '<td>'.$ar['bifsc'].'</td>';
                        echo '</tr>';
        echo '      </table>
                </div>';
        
        
        //community leader reference
        echo '<h3>Community leader\'s reference Details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Community Leader\'s Name</th>
                                <th>Community Leader\'s Address</th>
                                <th>Community Leader\'s Phone</th>
                            </tr>
                        </thead>
                    ';
                    echo '<tr>';
                            echo '<td>'.$ar['cname'].'</td>';
                            echo '<td>'.$ar['cadd'].'</td>';
                            echo '<td>'.$ar['cphone'].'</td>';
                        echo '</tr>';
        echo '      </table>
                </div>';
        //teacher reference
        echo '<h3>Teacher\'s reference details</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Teacher\'s Name</th>
                                <th>Teacher\'s Address</th>
                                <th>teacher\'s Phone</th>
                            </tr>
                        </thead>
                    ';
                    echo '<tr>';
                            echo '<td>'.$ar['tname'].'</td>';
                            echo '<td>'.$ar['tadd'].'</td>';
                            echo '<td>'.$ar['tphone'].'</td>';
                        echo '</tr>';
        echo '      </table>
                </div>';
    }
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
    /*public function putSchDoc($uid){
        $url = "http://cloudotron.com/projects/macwan-rebuilt/";
        $sql = $this->load->database->query(
            "select doc_type,doc_name from doc where uid='".$uid."' and doc_type!='cm_file' and doc_type!='vo_file'",
            "raw");
        $ar = array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($ar,$row);
        }
        
        $sql2 = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type='cm_file' or doc_type='vo_file' and fo!='ec'","raw");
        $mr = array();
        $vo="";$cm="";
        $c=1;$d=1;
        while($roww = mysqli_fetch_assoc($sql2)){
            if($roww['doc_type'] == "vo_file"){
                $vo .= "<a class='btn btn-sm btn-primary' href='".$url.'storage/'.$roww['doc_name']."'>Volunteering activity - ".$c."</a>,";
                $c++;
            }
        }
        $sql3 = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type='cm_file' and fo!='ec'","raw");
        
        while($roww = mysqli_fetch_assoc($sql3)){
            if($roww['doc_type'] == "cm_file"){
                $cm .= "<a class='btn btn-sm btn-success' href='".$url.'storage/'.$roww['doc_name']."'>achievement - ".$d."</a>,";
                $d++;
            }
        }
        $mr['cm']=$cm;$mr['vo']=$vo;
        
        
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
                            echo '<td><a href="'.$url.'storage/'.$ar[$i]['doc_name'].'" class="btn btn-sm btn-info">Open Document</a></td>';
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
                            $a = explode(",",$mr['vo']);
                            for($j=0;$j<count($a);$j++){
                                echo $a[$j]." ";
                            }
                            echo '</td>';
                    echo '</tr>';
                    
                    
        echo '      </table>
                </div>';
        }else{
            echo "No Document Found!";
        }
        
    } */
    public function putSchDoc($uid){
        $sql = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type!='cm_file' and doc_type!='vo_file'","raw");
        $ar = array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($ar,$row);
        }
        
        $url = "http://cloudotron.com/projects/macwan-rebuilt/";
        
        $sql2 = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and doc_type='vo_file' and fo is null","raw");
        $mr = array();
        $vo="";$cm="";
        $c=1;$d=1;
        while($roww = mysqli_fetch_assoc($sql2)){
            if($roww['doc_type'] == "vo_file"){
                $vo .= "<a class='btn btn-sm btn-primary' href='".$url.'storage/'.$roww['doc_name']."'>Volunteering activity - ".$c."</a>,";
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
        
        
        
        
        
        //echo "<pre>";var_dump($v);echo "</pre>";
        //echo "<pre>";print_r($voa);echo "</pre>";
        
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
                            echo '<td><a href="'.$url.'storage/'.$ar[$i]['doc_name'].'" class="btn btn-sm btn-info">Open Document</a></td>';
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
        $url = "http://cloudotron.com/projects/macwan-rebuilt/";
        
        $sql = $this->load->database->query("select doc_type,doc_name from doc where uid='".$uid."' and fo='ec'","raw");
        $sq = mysqli_fetch_assoc($sql);
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
                        <td><a target="_blank" href="'.$url.'storage/'.$row['doc_name'].'" class="btn btn-primary btn-sm">Open Document</a></td>
                  </tr>';
                }
                
                
                
        echo '  </tbody>
                    </table>
                    </div>';
        
    }
    
    /* get application for a particular user */
    public function getScholarshipData($uid){
        $sql = $this->load->database->select("user","","","","");
        $ar = mysqli_fetch_array($sql);
        if($ar['uform'] == "1"){
            $sql1 = $this->load->database->select("scholarship","uid='".$uid."'","","","");
            $this->putScholarship($uid,$sql1);
            $this->putSchDoc($uid);
        }
        /*else{
            $sql1 = $this->load->database->select("ec_form","","","","");
            $this->putEc($sql1);
        }*/
    }
    public function getDocuments($uid){
        
    }
    /* end */
    public function getStatus($uid){
        $sql = $this->load->database->select("status","uid='".$uid."'","","order by sid desc","");
        if(mysqli_num_rows($sql)){
            echo '<br>';
            while($row = mysqli_fetch_assoc($sql)){
                if($row['imp'] == "d"){
                    echo '<p class="alert alert-danger">'.$row['status'].' - <b>'.$row['dt'].'</b></p>';
                }else if($row['imp'] == "n"){
                    echo '<p class="alert alert-info">'.$row['status'].' - <b>'.$row['dt'].'</b></p>';
                }else{
                    echo '<p class="alert alert-success">'.$row['status'].' - <b>'.$row['dt'].'</b></p>';
                }
                
            }
        }else{
            echo "No Status updated yet.";
        }
    }
    
    public function uinfo($uid){
        $sql = $this->load->database->select("user","uid='".$uid."'","","","");
        return mysqli_fetch_assoc($sql);
    }
    
    public function get_scheduled_date($uid){
        $sql = $this->load->database->select("interviews","uid='".$uid."'","","","");
        if(mysqli_num_rows($sql)){
            $ar = mysqli_fetch_assoc($sql);
            return $ar['idt'];
        }
    }
    
    public function update_application($uid,$status,$app){
            $t = "";
            if($status == "A"){
                $t = "approved";
            }else{
                $t = "rejected";
            }
        if($app == "1"){
            $sql = $this->load->database->update("user","sch_status='".$status."'","uid='".$uid."'");
            $sql = $this->load->database->query("insert into status(uid,status,dt,imp) values('".$uid."','Your Scholarship Application has been ".$t."','".date("d-m-Y")."','g')","");
        }else if($app == "2"){
            $sql = $this->load->database->update("user","ec_status='".$status."'","uid='".$uid."'");
            $sql = $this->load->database->query("insert into status(uid,status,dt,imp) values('".$uid."','Your EC Application has been ".$t."','".date("d-m-Y")."','g')","");
        }else{
            echo "Nothing action is being taken";
        }
        
    }
    public function userInfo($uid){
        $sql = $this->load->database->select("user","uid='".$uid."'","","","");
        return mysqli_fetch_array($sql);
    }
    public function addTransaction($uid,$msg,$file){
        $tft = $file['tfile']['tmp_name'];
        $ft = $file['tfile']['name'];
        $ft = $this->load->security->otp("6").$ft;
        if(move_uploaded_file($tft,"../storage/".$ft)){
            $m = $msg.' <a href="http://localhost/scholarzonee/storage/'.$ft.'">Please find the transaction receipt here</a>';
            //echo "<br>From Debugger: ".$m;
            $sql = $this->load->database->query("insert into status(uid,status,dt,tp) values('".$uid."','".$m."','".date("d-m-Y")."','T')","");
            if($sql){
                return true;
            }else{
                return false;
            }
        }else{
            echo "Unable to upload files.";
        }
        
    }
    public function getTransaction($uid){
        $sql = $this->load->database->select("status","uid='".$uid."' and tp='T'","","","");
        if(mysqli_num_rows($sql) >0){
            while($row = mysqli_fetch_assoc($sql)){
                echo '<tr>';
                    echo '<td>'.$row['uid'].'</td>';
                    echo '<td>'.$row['status'].'</td>';
                    echo '<td>'.$row['dt'].'</td>';
                    
                echo '</tr>';
            }
        }else{
            echo "<h3>No transaction found!</h3>";
        }
    }
    public function getReceipt($uid){
        $url = "http://localhost/scholarzonee/";
        
        $sql = $this->load->database->select("receipt","uid='".$uid."'","","","");
        if(mysqli_num_rows($sql)){
            echo '
        <h3>Receipt Data</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Receipt Date</th>
                    <th>Receipt link</th>
                    
                  </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_array($sql)){
                    echo '<tr>
                        <td>'.$row['dt'].'</td>
                        <td><a target="_blank" href="'.$url.'storage/'.$row['fname'].'" class="btn btn-primary btn-sm">Open Document</a></td>
                  </tr>';
                }
                
                
                
        echo '  </tbody>
                    </table>
                    </div>';
        }
    }
    
    public function getReapply($uid){
        $url = "http://localhost/scholarzonee/";
        
        $sql = $this->load->database->select("reapply","uid='".$uid."'","","","");
        if(mysqli_num_rows($sql)){
            echo '
        <h3>Receipt Data</h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Semester</th>
                    <th>Marks Card</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_array($sql)){
                    echo '<tr>
                        <td>'.$row['sem'].'</td>
                        <td><a target="_blank" href="'.$url.'storage/'.$row['mcard'].'" class="btn btn-primary btn-sm">Open Document</a></td>
                        <td>'.$row['dt'].'</td>
                        <td>'.$row['note'].'</td>
                        <td>'.$row['status'].'</td>';
                        if($row['status'] == "P"){
                             echo '<td>
                                <a href="accept-reapply.php?uid='.$row['rid'].'&u='.$row['uid'].'" class="btn btn-sm btn-success">Accept</a>
                                <a href="reject-reapply.php?uid='.$row['rid'].'" class="btn btn-sm btn-danger">Reject</a>
                            </td>';
                        }else if($row['status'] == "R"){
                             echo '<td>Already Rejected!</td>';
                        }else if($row['status'] == "A"){
                             echo '<td>Already Accepted!</td>';
                        }
                       
                  echo '</tr>';
                }
                
                
                
        echo '  </tbody>
                    </table>
                    </div>';
        }
    }
    public function rejectReapply($rid,$com){
        $sql = $this->load->database->select("reapply","rid='".$rid."'","","","");
        $ar = mysqli_fetch_array($sql);
        if($ar['status'] == "R"){
            echo "Already Rejected";
        }else{
            $up = $this->load->database->update("reapply","status='R',note='".$com."'","rid='".$rid."'");
            $in = $this->load->database->insert("status","uid,status,dt,imp","'".$ar['uid']."','".$com."','".date("d-m-Y")."','d'");
            if($up){
                return true;
            }else{
                return false;
            }
        }
    }
    public function acceptReapply($rid){
        $sql = $this->load->database->select("reapply","rid='".$rid."'","","","");
        $ar = mysqli_fetch_array($sql);
        if($ar['status'] == "R"){
            echo "Already Rejected";
        }else{
            $up = $this->load->database->update("reapply","status='A'","rid='".$rid."'");
            $in = $this->load->database->insert("status","uid,status,dt,imp","'".$ar['uid']."','Your reapply request has been accepted','".date("d-m-Y")."','d'");
            if($up){
                return true;
            }else{
                return false;
            }
        }
    }
    
}
?>