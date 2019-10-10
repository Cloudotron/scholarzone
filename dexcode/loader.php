<?php

/*
 * This script belongs to DexCode library. * 
 * By: Sumanta Sharma (Creator of DexCode) * 
 * Modification without permission is not allowed  * 
 */

/**
 * Description of loader
 * This will load all the classes of this library
 * @author sumanta
 * 
 */
include_once 'config.php';
include_once 'core/handler/report.php';
include_once 'core/database/database.php';
include_once 'core/security/security.php';
include_once 'core/handler/validation.php';
include_once 'api/phpmailer/autoload.php';
include_once 'core/email/email.php';
include_once 'core/email/template.php';

class loader {
    //put your code here
    public $database;
    public $security;
    public $validation;
    public $email;
    public $template;
    
    public function __construct() {
        $this->database = new database;
        $this->security = new security;
        $this->validation = new validation;
        $this->email = new email();
        $this->template = new template();
    }
}
