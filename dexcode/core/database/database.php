<?php
error_reporting(E_ALL);
class database extends report{
    //put your code here
    private $con;
    private $error;
    public function __construct() {
        $this->error = new report;
        try{
            $this->con = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME) or die("Error!");

        }catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(), $ex->getLine(), $ex->getFile(), $ex->getTraceAsString());
        }
    }

    /*
     * debug_connection() - this will help to check the connection object on the go
     */
    public function debug_connection(){
        try{
            if($this->con){
                echo "<pre>DATABASE CONNECTION ESTABLISHED</pre>";
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(), $ex->getLine(), $ex->getFile(), $ex->getTraceAsString());
        }
    }

    /*
     * query() - this will help to execute your own query if any functionality does not
     * exist in this library
     */
    public function query($sql="",$return=""){
        try{
            if($sql == ""){
                throw new Exception("Null Query can not be executed!");
            }else{
                $rs=mysqli_query($this->con,$sql);
                switch($return){
                    case "array":
                        return mysqli_fetch_assoc($rs);
                        break;
                    case "count":
                        return mysqli_num_rows($rs);
                    break;
                    case "raw":
                        return $rs;
                    break;
                    default:
                        return true;
                    break;
                }
                mysqli_close($this->con);
            }
        } catch (Exception $ex){
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }
    /* debug_query() - it will help you to debug the query  */
    public function debug_query($sql=""){
        echo "<pre>";print_r($sql);echo "</pre>";
    }

    /* select() - Method for select query in database. */
    public function select($table,$condition="",$limit="",$order="",$return=""){
        try{
            if($table == ""){
                throw new Exception("Table Null! Valid name expected");
            }else if($condition == "" && $limit == "" && $order == ""){
                $sql = "select * from $table";
            }else{
                $sql = "select * from $table where $condition $limit $order";
            }
            $result=mysqli_query($this->con,$sql);

            switch($return){
                case "":
                    return $result;
                break;
                case "row/count":
                    return mysqli_num_rows($result);
                break;
                case "array":
                    return mysqli_fetch_assoc($result);
                break;
                default:
                    return true;
                break;
            }
            mysqli_close($this->con);
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    /* debug_select() - for debugging the select query if error occured!*/
    public function debug_select($table,$condition="",$limit="",$order="",$return=""){
        try{
            echo "Table: ".$table."<br>";
            echo "Condition: ".$condition."<br>";
            echo "limit: ".$limit."<br>";
            echo "order: ".$order."<br>";
            echo "return: ".$return."<br>";
            if($table == ""){
                $sql = "no table name given!";
            }else if($condition == "" && $limit == "" && $order == ""){
                $sql = "select * from $table";
                echo "<pre>";
                    echo $sql;
                echo "</pre>";
            }else{
                $sql = "select * from $table where $condition $limit $order";
                echo "<pre>";
                    echo $sql;
                echo "</pre>";
            }

        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    /* insert() - it will help to insert data to tables in configured database*/
    public function insert($table,$fields,$values){
        try{
            if($table == ""){
                throw new Exception("Table Name NULL!");
            }else if($fields == ""){
                throw new Exception("Fields parameter NULL!");
            }else if($values == ""){
                throw new Exception("Table Name NULL!");
            }else{
                $sql = "INSERT INTO $table($fields) VALUES($values)";
                $result = mysqli_query($this->con,$sql);
                mysqli_close($this->con);
                return true;
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    /* debug_insert() - debug the insert query*/
    public function debug_insert($table,$fields,$values){
        try{
            if($table == ""){
                throw new Exception("Table Name NULL!");
            }else if($fields == ""){
                throw new Exception("Fields parameter NULL!");
            }else if($values == ""){
                throw new Exception("Table Name NULL!");
            }else{
                $sql = "INSERT INTO $table($fields) VALUES($values)";
                echo "<pre>";
                    echo $sql;
                echo "</pre>";
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    public function update($table,$values,$condition,$return=""){
        try {
            if($table == ""){
                throw new Exception("Table name is NULL!");
            }else if($values == ""){
                throw new Exception("Value fields are NULL");
            }else if($condition == ""){
                throw new Exception("Condition is NULL");
            }else{
                $sql = "update $table set $values where $condition";
                $result = mysqli_query($this->con,$sql);
                switch($return){
                    case "":
                        return true;
                    break;
                    case "nor":
                        return mysqli_affected_rows($this->con);
                    break;
                }
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }
    public function debug_update($table,$values,$condition,$return=""){
        try {
            if($table == ""){
                throw new Exception("Table name is NULL!");
            }else if($values == ""){
                throw new Exception("Value fields are NULL");
            }else if($condition == ""){
                throw new Exception("Condition is NULL");
            }else{
                $sql = "update $table set $values where $condition";
                echo "<pre>";print_r($sql."| Return Type: ".$return);echo "</pre>";
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    public function delete($table,$condition,$return=""){
        try{
            if($table == ""){
                throw new Exception("Table name is NULL");
            }else if($condition == ""){
                throw new Exception("NULL Condition provided!");
            }else{
                $sql = "DELETE FROM MyGuests WHERE id=3";
                $result = mysqli_query($this->con, $sql);
                switch($return){
                    case "":
                        return true;
                    break;
                    case "nor":
                        return mysqli_affected_rows($this->con);
                    break;
                }
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }
    public function debug_delete($table,$condition,$return=""){
        try{
            if($table == ""){
                throw new Exception("Table name is NULL");
            }else if($condition == ""){
                throw new Exception("NULL Condition provided!");
            }else{
                $sql = "DELETE FROM MyGuests WHERE id=3";
                echo "<pre>";print_r($sql."| Return Type: ".$return);echo "</pre>";
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    /* insert unique*/
    public function insert_unique($table,$fields,$values,$checker){
        try{
            if($table == ""){
                throw new Exception("Table Name NULL!");
            }else if($fields == ""){
                throw new Exception("Fields parameter NULL!");
            }else if($values == ""){
                throw new Exception("Table Name NULL!");
            }else if($checker == ""){
                throw new Exception("Cehcker value missed!");
            }else{
                $main_query = "INSERT INTO $table($fields) VALUES($values)";

                $check_query = "SELECT * FROM $table WHERE $checker";


                $rs = mysqli_query($this->con,$check_query);
                if(mysqli_num_rows($rs)>0){
                    echo "Failed!";
                    throw new Exception("Duplicate Entry found!");
                    return false;
                }else{
                    mysqli_query($this->con,$main_query);
                    return true;
                }
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }

    /* debug_insert() - debug the insert query*/
    public function debug_insert_unique($table,$fields,$values,$checker){
        try{
            if($table == ""){
                throw new Exception("Table Name NULL!");
            }else if($fields == ""){
                throw new Exception("Fields parameter NULL!");
            }else if($values == ""){
                throw new Exception("Table Name NULL!");
            }else if($checker == ""){
                throw new Exception("Cehcker value missed!");
            }else{
                $sql1 = "INSERT INTO $table($fields) VALUES($values)";
                $sql = "SELECT * FROM $table WHERE $checker";
                echo "<pre>";
                    print_r($sql1);
                    print_r($sql);
                echo "</pre>";
            }
        } catch (Exception $ex) {
            $this->error->show($ex->getMessage(),$ex->getCode(),$ex->getLine(),$ex->getFile(),$ex->getTraceAsString());
        }
    }




}
?>
