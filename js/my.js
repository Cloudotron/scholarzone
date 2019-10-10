function __(et){
    return document.getElementById(et);
}
function year(){
    var e = __("scheme");
    var sch = e.options[e.selectedIndex].value;

    if(sch == "D"){
        alert("Please select any scheme");
    }else if(sch == "Y"){
        __("sem_scheme").className = "hide";
        __("year_scheme").className = "show";
    }else if(sch == "S"){
        __("year_scheme").className = "hide";
        __("sem_scheme").className = "show";
    }
}
function getYearApplying(){
     __("yapp").innerHTML = "";
    //get the total year
    var t = __("tot");
    var total = t.options[t.selectedIndex].value;
    console.log(total);
    if(total == "D"){
        alert("Select total year.");
    }else{
        var e = __("currentYear");
        var sch = e.options[e.selectedIndex].value;

        //yapp
        for(var i=sch;i<=total;i++){
            
            __("yapp").innerHTML += "<option value='"+i+"'>"+i+"</option>";
        }
    }
}

function loadTotalSem(){
    __("cursem").innerHTML = "";
    var t = __("tots");
    var total = t.options[t.selectedIndex].value;
    __("cursem").innerHTML = "<option value='D'>--Select--</option>"
    for(var i=1;i<=total;i++){
        __("cursem").innerHTML += "<option value='"+i+"'>"+i+"</option>";
    }
}
function loadTotalYear(){
    __("currentYear").innerHTML = "";
    var t = __("tot");
    var total = t.options[t.selectedIndex].value;
    for(var i=1;i<=total;i++){
        __("currentYear").innerHTML += "<option value='"+i+"'>"+i+"</option>";
    }
}

function getSemApplying(){
    __("sapp").innerHTML = "";
    //get the total year
    var t = __("tots");
    var total = t.options[t.selectedIndex].value;
    console.log(total);
    if(total == "D"){
        alert("Select total year.");
    }else{
        var e = __("cursem");
        var sch = e.options[e.selectedIndex].value;
        if(sch == "D"){
            alert("Select a valid sem");
        }else{
            for(var i=sch;i<=total;i++){
                __("sapp").innerHTML += "<option value='"+i+"'>"+i+"</option>";
            }
        }
    }
}

function savePhse1(){
    __("nextphase1").disabled = false;
}
function loadothersch(){
    var t  = __("other_sch");
    var sch = t.options[t.selectedIndex].value;
    
    if(sch == "D"){
        alert("Please select any option");
    }else if(sch == "Y"){
        __("sch_det").className = "show";
    }else if(sch == "N"){
        __("sch_det").className = "hide";
    }
}
function mark(id){
    for(var i=0;i<id.length;i++){
        __(id[i]).className = "form-control red";
    }
}
function unmark(id){
    for(var i=0;i<id.length;i++){
        //console.log(id[i]);
        __(id[i]).classList.remove("red")
    }
}

/*validation functions start*/
function phonev(e)
{
  var phoneno = /^\d{10}$/;
  if(e.match(phoneno)){
	  return true;
  }else{
	  return false;
  }
}
function emailv(e) {
    var emailID = e;
    atpos = emailID.indexOf("@");
    dotpos = emailID.lastIndexOf(".");
    if (atpos < 1 || ( dotpos - atpos < 2 )) {
       return false;
    }else{
    	return true;
    }
 }
 function pincode(e){
     if(e.length >6 || e.length < 6){
         return false;
     }else if(isNaN(e)){
        return false;
     }else{
         return true;
     }
 }
 function error(id,msg){
     __(id).className="alert alert-danger";
     __(id).innerHTML = msg;
 }
 function success(id,msg){
     __(id).className = "alert alert-success";
     __(id).innerHTML = msg;
 }
 function wait(id,msg){
     __(id).className = "alert alert-info";
     __(id).innerHTML = msg;
 }
/*validation function end*/

/* validate phase 1 start */
function validatePhase1(){
    __("phase_1_error").className = "";
    //__("phase_1_error").innerHTML = "";
    wait("phase_1_error","Wait..saving your informations!")
    var phone = __("phone").value;
    //var email = __("email").value;
    var address = __("address").value;
    var pin = __("pin").value;
    var fat_name = __("fat_name").value;
    
    
    var foccu = __("foccu");
    var fo = foccu.options[foccu.selectedIndex].value; //value from dropdown
    
    
    var mot = __("mot_name").value;
    var moccu = __("moccu");
    var mo = moccu.options[moccu.selectedIndex].value; //value from dropdown
    
    
    var family_income = __("family_income");
    var fi = 100
    
    
    console.log(phone+"="+address+"="+pin+"="+fat_name+"="+fo+"="+mot+"="+mo+"="+fi);
    
    if(address == "" || address == " " || pin =="" || pin == " " ||fat_name == "" || fat_name == " " || fo == "" || fo == " " || mot == "" || mot ==" " || fi=="" || fi==" "){
        mark(["address","pin","fat_name","mot_name"]);
        error("phase_1_error","All he marked fields are required!");
    }else{
        unmark(["phone","address","pin","fat_name","mot_name"]);
        if(phonev(phone) == false){
            mark(["phone"]);
            error("phase_1_error","Phone number should be 10 digit only");
        }else if(pincode(pin) == false){
            unmark(["phone"]);
            mark(["pin"]);
            error("phase_1_error","PIN no should be 6 digit only");
        }else{
            unmark(["phone","pin"]);
            var url = "api/save_phase_1.php";
            var data = {"address":address,"pin":pin,"fname":fat_name,"foocu":fo,"mname":mot,"moccu":mo,"fincome":fi};
            
            //make the ajax call start 
                xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = function () { 
                    if (xhr.readyState == 4 && xhr.status == 200) {
                         console.log(xhr.responseText);
                         
                        var res = JSON.parse(xhr.responseText);
                        if(res.status == "true"){
                            success("phase_1_error",res.msg);
                            __("nextphase1").disabled = false;
                            window.location = 'apply-now.php';
                        }else{
                            error("phase_1_error",res.msg);
                        }
                    }
                }
                var data = JSON.stringify(data);
                xhr.send(data);
            //ajax call end
        }
    }
}
/* validatation phase 1 end*/


function register(){
    var fname = __("fname").value;
    var lname = __("lname").value;
    var email = __("email").value;
    var contact = __("phone").value;
    //console.log(cont);
    var pass = __("pass").value;
    var g = __("gender");
    var gender = g.options[g.selectedIndex].value; //value from dropdown
    
    
    if(fname == "" || fname == " "){
        mark(['fname']);
        error("registration_error","First name is required!");
    }else if(lname == "" || fname == " "){
        unmark(["fname"]);
        mark(["lname"]);
        error("registration_error","Last name is required!");
    }else if(email == "" || email == " " || !emailv(email)){
        unmark(["fname","lname"]);
        mark(["email"]);
        error("registration_error","Email name is required/not in correct format!");
    }else if(pass  == "" || pass == " "){
        unmark(["fname","lname","email"]);
        mark(["pass"]);
        error("registration_error","Password required!");
    }else if(contact == "" || contact == " " || !phonev(contact)){
        unmark(["fname","lname","email","pass"]);
        mark(["phone"]);
        error("registration_error","Phone no is required/not in correct format!");
    }else{
        unmark(["fname","lname","email","pass","phone"]);
        
            var url = "api/registration.php";
            //make the ajax call start 
            wait("registration_error","Wait....Processing your request.");
                xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = function () { 
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        //console.log(xhr.responseText);
                        var res = JSON.parse(xhr.responseText);
                        //console.log(res);
                        if(res.status == "true"){
                            success("registration_error",res.msg);
                        }else{
                            error("registration_error",res.msg);
                        }
                        
                    }
                }
                var j = {
                    "fname":fname,
                    "lname":lname,
                    "email":email,
                    "pass":pass,
                    "phone":contact,
                    "gen":gender
                }
                console.log(j);
                var data = JSON.stringify(j);
                xhr.send(data);
            //ajax call end
        
    }
    
    
}

function getPhase1Data(){
    console.log("Inside getPhase1Data");
    var url = "api/get_phase_1.php";
    xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () { 
        if (xhr.readyState == 4 && xhr.status == 200) {
            var r = xhr.responseText;
            var res = JSON.parse(r);
           if([res].length > 0){
                    // console.log(res);
                    // console.log([res].fname);
                    __("nextphase1").disabled = false;
                    __("display_phase_2_btn").className = "show";
                    __("address").value = res.addr;
                    __("pin").value = res.pin;
                    __("fat_name").value = res.fname;
                    __("mot_name").value = res.mname;
                    
                    var foccu = __("foccu");
                    foccu.options[foccu.selectedIndex].value = res.foccu; 
                    
                    var moccu = __("moccu");
                    moccu.options[moccu.selectedIndex].value = res.moccu;
                    
                    var family_income = __("family_income");
                    family_income.options[family_income.selectedIndex].value = res.fincome;
            }else{
                return;
            }
        }
    }
    var j = {"data":"demo"}
    //console.log(j);
    var data = JSON.stringify(j);
    xhr.send(data);
}

function nexbtn_phase1(){
    //__("collapseTwo4").style.display = ""
    __("collapseTwo4").style.display = null;
    $("#collapseTwo4").collapse('show');
    $("#collapseOne4").collapse('hide');
    __("display_phase_2_btn").className = "show";
}
function nextbtn_phase2(){
     __("collapseThree4").style.display = null;
    $("#collapseThree4").collapse('show');
    $("#collapseTwo4").collapse('hide');
    //__("display_phase_2_btn").className = "show";
}



function validatePhase2(){
    wait("phase_2_error","Wait.Processing your request..");
    var course_name = __("course_name").value;
    
    var scheme = __("scheme");
    var sc = scheme.options[scheme.selectedIndex].value;
    var total="";
    var current = "";
    var applying = "";
    
    var col_name = __("col_name").value;
    var col_ph = __("col_ph").value;
    var col_add = __("col_add").value;
    var col_pin = __("col_pin").value;
    var col_wb = __("col_wb").value;

    var ten_per = __("tp").value; 
    var tw_per = __("twp").value;
    var grad_per = __("gdp").value;
    
    if(course_name == "" || course_name == " "){
        error("phase_2_error","Course name is required");
        mark(["course_name"]);
        //break validatePhase2;
        return;
    }else if(sc == "Y"){
        var tot = __("tot");
        total = tot.options[tot.selectedIndex].value;
        
        //var cy = __("currentYear");
        current = 0
        
        var yapp = __("yapp");
        applying = yapp.options[yapp.selectedIndex].value;
    }else if(sc == "S"){
        var tot = __("tots");
        total = tot.options[tot.selectedIndex].value;
        
        //var cy = __("cursem");
        current = 0;
        
        var yapp = __("sapp");
        applying = yapp.options[yapp.selectedIndex].value;
    }else if(sc == "D"){
        error("phase_2_error","Select course scheme");
        unmark(["course_name"]);
        mark(["scheme"]);
        return;
    }
    
    if(col_name == "" || col_name == " "){
        error("phase_2_error","College name is required!");
        unmark(["course_name","scheme"]);
        mark(["col_name"]);
    }else if(col_add == "" || col_add == " "){
        error("phase_2_error","College address is required!");
        unmark(["course_name","col_name"]);
        mark(["col_add"]);
    }else if(col_pin == "" || col_pin == " " || pincode(col_pin) == false){
        error("phase_2_error","Valid college PIN code is required!");
        unmark(["course_name","col_name","col_add"]);
        mark(["col_pin"]);
    }else if(col_ph == "" || col_ph == " "){
        error("phase_2_error","College Phone no is required!");
        unmark(["course_name","col_name","col_pin"]);
        mark(["col_ph"]);
    }else{
        wait("phase_2_error","Please wait. Processing your request");
        unmark(["course_name","col_name","col_pin"]);
        //ajax start 
                var url = "api/save_phase_2.php";
                xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = function () { 
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var res = JSON.parse(xhr.responseText);
                            //console.log(xhr.responseText);
                        if(res.status == "true"){
                            success("phase_2_error",res.msg);
                            //__("nextphase3").disabled = false;
                            window.location = 'apply-now.php';
                            //__("nextphase3").setAttribute("onclick","openPhase3()");
                            document.getElementById('nextphase3').setAttribute('onclick','openPhase3()');
                        }else{
                            error("phase_2_error",res.msg);
                        }
                    }
                }   
                
                var j = {
                    "course_name":course_name,
                    "scheme":sc,
                    "total":total,
                    "current":current,
                    "applying":applying,
                    "col_name":col_name,
                    "col_ph":col_ph,
                    "col_add":col_add,
                    "col_pin":col_pin,
                    "col_wb":col_wb,
                    "ten_per":ten_per,
                    "tw_per":tw_per,
                    "grad_per" :grad_per
                }
                console.log(j);
                var data = JSON.stringify(j);
                xhr.send(data);
        //ajax end
    }
}

function openPhase3(){
    console.log("working");
    __("collapseThree4").style.display = null;
    $("#collapseTwo4").collapse('hide');
    $("#collapseThree4").collapse('show');
    
    
}

function getPhase2Data(){
    var url = "api/get_phase_2.php";
    xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () { 
        if (xhr.readyState == 4 && xhr.status == 200) {
            var r = xhr.responseText;
            //console.log(r);
            
            var res = JSON.parse(r);
            console.log(res);
            console.log([res].length);
            //var count = Object.keys(r).length;
            //console.log(count);
            if([res].length > 0){
                    __("collapseTwo4").style.display =null;
                    __("nextphase3").disabled = false;
                    __("display_phase_2_btn").className = "show";
                    document.getElementById('nextphase3').setAttribute('onclick','openPhase3()');
                    //__("display_phase_2_btn").className = "show";
                    __("fat_name").value = res.fname;
                    __("course_name").value = res.course;
                    __("col_name").value = res.col_name;
                    __("col_add").value = res.col_add;
                    __("col_pin").value = res.col_pin;
                    __("col_wb").value = res.col_web;
                    __("col_ph").value = res.col_phone;
                    
                    
            }else{
                return;
            }
        }
    }
    var j = {"data":"demo"}
    //console.log(j);
    var data = JSON.stringify(j);
    xhr.send(data);
}


function login(){
    var email = __("email").value;
    var pass = __("pass").value;
    if(email == "" || email == " " || emailv(email) == "false"){
        mark(["email"]);
        error("login_error","Invalid email provided!");
    }else if(pass == "" || pass == " "){
        unmark(["email"]);
        mark(["pass"]);
        error("login_error","Password can not be empty!");
    }else{
        unmark(["email","pass"]);
        var url = "api/login.php";
            //make the ajax call start 
            wait("login_error","Wait....Processing your request.");
                xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = function () { 
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var res = JSON.parse(xhr.responseText);
                        //console.log(res);
                        if(res.status == "true"){
                            success("login_error",res.msg);
                            window.location = "dashboard.php";
                        }else{
                            error("login_error",res.msg);
                        }
                        //console.log(xhr.responseText);
                        
                    }
                }
                var j = {"email":email,"pass":pass}
                console.log(j);
                var data = JSON.stringify(j);
                xhr.send(data);
            //ajax call end
        
    }
}


function savePhase3(){
    var yapp = __("other_sch");
    var osch = yapp.options[yapp.selectedIndex].value;
    
    
    var oamt=__("oamt").value;
    var osource = __("osource").value;
    
    var bname = __("bname").value;
    var badd = __("badd").value;
    var bacc = __("bacc").value;
    var bifsc = __("bifsc").value;
    
    var cname = __("cname").value;
    var cphone = __("cphone").value;
    var cadd = __("cadd").value;
    
    var tname = __("tname").value;
    var tphone = __("tphone").value;
    var tadd = __("tadd").value;
    
    /*var jk = {"osch":osch,"oamt":oamt,"osource":osource,"bname":bname,"badd":badd,"bacc":bacc,
                "bifsc":bifsc,"cname":cname,"cphone":cphone,"cadd":cadd,"tname":tname,"tadd":tadd,"tphone":tphone}*/
      
    if(osch == "D"){
        error("phase_3_error","Select a valid Option");
        mark(["other_sch"]);
        
    }else if(cname == ""){
        unmark(["bname","badd","bacc","bifsc","other_sch","oamt","osource"]);
        mark(["cname"]);
        error("phase_3_error","Community leader name is required!");
    }else if(cphone == "" || phonev(cphone) == false){
        unmark(["bname","badd","bacc","bifsc","cname","other_sch","oamt","osource"]);
        mark(["cphone"]);
        error("phase_3_error","Community leader phone number is required!");
    }else if(cadd == ""){
        unmark(["bname","badd","bacc","bifsc","cname","cphone","other_sch","oamt","osource"]);
        mark(["cadd"]);
        error("phase_3_error","Community leader address is required!");
    }else if(tname == ""){
        unmark(["bname","badd","bacc","bifsc","cname","cphone","cadd","other_sch","oamt","osource"]);
        mark(["tname"]);
        error("phase_3_error","Teacher's name is required!");
    }else if(tphone == "" || phonev(tphone) == false){
        unmark(["bname","badd","bacc","bifsc","cname","cphone","cadd","tname","other_sch","oamt","osource"]);
        mark(["tphone"]);
        error("phase_3_error","Teacher's phone number is required!");
    }else if(tadd == ""){
        unmark(["bname","badd","bacc","bifsc","cname","cphone","cadd","tname","tphone","other_sch","oamt","osource"]);
        mark(["tadd"]);
        error("phase_3_error","Teacher's address is required!");
    }else{
        unmark(["bname","badd","bacc","bifsc","cname","cphone","cadd","tname","tphone","tadd","other_sch","oamt","osource"]);
        
        var url = "api/save_phase_3.php";
            //make the ajax call start 
            wait("phase_3_error","Wait....Processing your request.");
                xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.onreadystatechange = function () { 
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var res = JSON.parse(xhr.responseText);
                        //console.log("Response"+xhr.responseText);
                        if(res.status == "true"){
                            success("phase_3_error",res.msg);
                            window.location = 'apply-now.php';
                        }else{
                            error("phase_3_error",res.msg);
                        }
                        //console.log(xhr.responseText);
                        
                    }
                }
                var j = {"osch":osch,"oamt":oamt,"osource":osource,"bname":bname,"badd":badd,"bacc":bacc,
                "bifsc":bifsc,"cname":cname,"cphone":cphone,"cadd":cadd,"tname":tname,"tadd":tadd,"tphone":tphone}
                console.log("Requested Json"+j);
                var data = JSON.stringify(j);
                xhr.send(data);
            //ajax call end
    }
    console.log(jk);
    
    
    
}


