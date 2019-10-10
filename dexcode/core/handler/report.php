<?php

/*
 * This script belongs to DexCode library. * 
 * By: Sumanta Sharma (Creator of DexCode) * 
 * Modification without permission is not allowed  * 
 */

/**
 * Description of errpr
 *
 * @author sumanta
 */
class report{
    public function show($msg,$code,$line,$file,$trace){
        $err = '<div style="border:1px solid #000;border-radius:5px; padding:5px;">'
                . '<div style="padding:5px;">'
                . '<p><span style="color:red;">Message: </span> '.$msg.'</p>'
                . '<p><span style="color:red;">Error Code: </span> '.$code.'</p>'
                . '<p><span style="color:red;">Line: </span> '.$line.'</p>'
                . '<p><span style="color:red;">File: </span> '.$file.'</p>'
                . '<p><span style="color:red;">Trace: </span> '.$trace.'</p>'
                . '</div>'
                . '</div>'
            ;
        echo $err;        
    }
    
    
}
