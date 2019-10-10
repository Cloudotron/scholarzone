<?php

/*
 * This script belongs to DexCode library. *
 * By: Sumanta Sharma (Creator of DexCode) *
 * Modification without permission is not allowed  *
 */

/**
 * Description of validation
 *
 * @author sumanta
 */
class validation {
    //put your code here
    public function email($input){
        if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $input) == true){
            return true;
	}else{
            return false;
        }
    }

    public function text($input){
        if(preg_match("/^[a-zA-Z ]*$/",$input) == true){
            return true;
	}else{
            return false;
	}
    }

    public function number($input){
        if(preg_match("/^[0-9]*$/",$input) == true){
            return true;
        }else{
            return false;
        }
    }

    public function mobile($input){
        if(preg_match("/^\d{10}$/", $input) == true){
            return true;
        }else{
            return false;
        }
    }

    public function password($input){
        if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/",$input) == true){
            return true;
        }else{
            return false;
        }
    }

    /*preg_match to check for the date against given pattern dd-mm-YYYY*/
    public function isdate($input){

        if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$input)){
            return false;
        }
        return true;
    }

}
