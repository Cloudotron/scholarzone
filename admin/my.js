function __(et){
    return document.getElementById(et);
}
function schedule_interview(uid){
    
      var xhttp = new XMLHttpRequest();
      var u = uid;
      var dt = __("datetimes").value;
      
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            __("res").innerHTML = this.responseText;
          console.log(this.responseText);
        }
      };
      xhttp.open("GET", "ajaxx/subInt.php?uid="+u+"&dt="+dt, true);
      xhttp.send();
}
function schedule_interview2(uid){
    
      var xhttp = new XMLHttpRequest();
      var u = uid;
      var dt = __("datetimes").value;
      
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            __("res").innerHTML = this.responseText;
          console.log(this.responseText);
        }
      };
      xhttp.open("GET", "ajaxx/subInt2.php?uid="+u+"&dt="+dt, true);
      xhttp.send();
}
function get_all_notes(uid){
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            __("notes_list").innerHTML = "";
            __("notes_list").innerHTML = this.responseText;
          console.log(this.responseText);
        }
      };
      xhttp.open("GET", "ajaxx/get_note.php?uid="+uid, true);
      xhttp.send();
}
function save_my_notes(uid){
    var xhttp = new XMLHttpRequest();
      var notes = __("note").value;
      
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            __("result").innerHTML = this.responseText;
            get_all_notes(uid);
          console.log(this.responseText);
        }
      };
      xhttp.open("GET", "ajaxx/save_note.php?uid="+uid+"&notes="+notes, true);
      xhttp.send();
}

function reject(app,uid){
    var note = __("r_note").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            __("ec_res").innerHTML = this.responseText;
            alert(this.responseText);
          console.log(this.responseText);
        }
      };
    xhttp.open("GET", "ajaxx/reject_note.php?uid="+uid+"&note="+note+"&app="+app, true);
    xhttp.send();
}

