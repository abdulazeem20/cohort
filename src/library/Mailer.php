<?php
//Load Composer's autoloader
require_once __DIR__ . '/./../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    protected  string $internName;
    protected  string $internEmail;
    protected  string $message;
    protected  string $subject;
    public function __construct(array $details)
    {
        foreach ($details as $key => $detail) {
            $this->$key = $detail;
        }
    }

    public function sendMail()
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'abdulazeemabdulazeez@gmail.com';                     //SMTP username
            $mail->Password   = 'xyazymsckxzazhvt';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('support@klemweb.com', 'Klemweb Cohort team');
            $mail->addAddress($this->internEmail, $this->internName);     //Add a recipient
            $mail->addReplyTo('support@klemweb.com', 'Klemweb Cohort team');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;

            $mail->send();
            echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
