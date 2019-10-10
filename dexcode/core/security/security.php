<?php
error_reporting(E_ALL);
/*
 * This script belongs to DexCode library. *
 * By: Sumanta Sharma (Creator of DexCode) *
 * Modification without permission is not allowed  *
 */

/**
 * Description of security
 *
 * @author sumanta
 */
class security {
    //put your code here
    public function otp($len=""){
        $result="";
        $guid = "6C528231AE40750AB934874D4F9242B1BE27A46F4D7E3C904297D2F71D75DFCA";
        if($len == ""){
            $guid = str_shuffle($guid);
            $guid=  strtoupper(hash_hmac('sha256', $guid, sha1(md5($guid))));
            for ($i = 1; $i <= 6; $i++) {
                $result .= substr($guid, (rand()%(strlen($guid))), 1);
            }
        }else{
            $guid = str_shuffle($guid);
            $guid=  strtoupper(hash_hmac('sha256', $guid, sha1(md5($guid))));
            for ($i = 1; $i <= $len; $i++) {
                $result .= substr($guid, (rand()%(strlen($guid))), 1);
            }
        }
        return $result;
    }

    public function escape($data){
        $data = str_replace("'", "", $data);
        $data = str_replace("/", "", $data);
        $data = str_replace('"', "", $data);
        $data = stripcslashes($data);
        $data = trim($data);
        $data = rtrim($data); // sql attack
        $data = htmlentities($data); // xxs attack
        $data = preg_replace("/javascript/i", "j&#097;v&#097;script",$data);
	      $data = preg_replace("/alert/i", "&#097;lert",$data);
      	$data = preg_replace("/about:/i", "&#097;bout:",$data);
      	$data = preg_replace("/onmouseover/i", "&#111;nmouseover",$data);
      	$data = preg_replace("/onclick/i", "&#111;nclick",$data);
      	$data = preg_replace("/onload/i", "&#111;nload",$data);
      	$data = preg_replace("/onsubmit/i", "&#111;nsubmit",$data);
      	$data = preg_replace("/<body/i", "&lt;body",$data);
      	$data = preg_replace("/<html/i", "&lt;html",$data);
      	$data = preg_replace("/document\./i", "&#100;ocument.",$data);
      	$data = preg_replace("/<script/i", "&lt;&#115;cript",$data);
        return $data;
    }

    

    public function encrypt($string){
        $pub_key=PUBLIC_KEY;
        openssl_get_publickey($pub_key);
        openssl_public_encrypt($string,$crypttext, $pub_key );
        return (base64_encode($crypttext));
    }

    public function decrypt($encryptedext){
        $priv_key=PRIVATE_KEY;
        $private_key = openssl_get_privatekey($priv_key);
        openssl_private_decrypt(base64_decode($encryptedext), $decrypted, $private_key);
        return $decrypted;
    }

}
