<?php 
class basic_admin{
    
    public function admin_login_table(){
        $sql="CREATE TABLE admin (
            aid int NOT NULL AUTO_INCREMENT,
            fname varchar(255) NOT NULL,
            uname varchar(255),
            pass Text,
            PRIMARY KEY (ID)
        )";
        $db = new database;
        $db->query($sql);
        echo "Admin table created<br>";
    }
    
    public function add_first_admin(){
        $security = new security;
        $name = "admin";
        $pass = $security->encrypt("admin");
        $db = new database;
        $db->insert("admin","fname,uname,pass","'Administration','".$uname."','".$pass."'");
        echo "Admin data Inserted: Uname: admin | Pass: admin";
    }
}

?>