<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require '../api/phpmailer/autoload.php';
class email{
    public $atta;
    public $bcc;
    public $cc;
    
    public function __construct(){
        $this->atta = "";
        $this->bcc = "";
        $this->cc = "";
    }
    
    public function add_cc($c){
        $this->cc = $c;
    }
    public function add_bcc($bc){
        $this->bcc = $bc;
    }
    
    public function attachment($at){
        $this->atta = $at;
    }
    public function send($sub,$body,$to,$name){
            $mail = new PHPMailer(true);                              
            try {
                //Server settings
                $mail->SMTPDebug = 0; //2                                 
                $mail->isSMTP();
                $mail->Host = EMAIL_SERVER;
                $mail->SMTPAuth = true;
                $mail->Username = EMAIL_ADDRESS;
                $mail->Password = EMAIL_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port = EMAIL_PORT;
                
                $mail->setFrom(EMAIL_ADDRESS, EMAIL_NAME);
                $mail->addReplyTo(EMAIL_ADDRESS, EMAIL_NAME);
                $mail->addAddress($to, $name);
                if($this->cc != ""){
                    $mail->addCC($this->cc);
                }
                if($this->bcc != ""){
                    $mail->addBCC($his->bcc);
                }
                //Attachments
                if($this->atta != ""){
                    $mail->addAttachment($this->atta);         // Add attachments
                }
                
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $sub;
                $mail->Body    = $body;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                //echo 'Message has been sent';
                return true;
            } catch (Exception $e) {
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                return false;
            }
            //email code ends 
    }
}
?>