<?php
require_once __DIR__ . "/./Mailer.php";

class Email
{

    protected array $details;
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function sendCongratulatoryMessage()
    {
        $subject = "Enrollment Sucessful";
        $internName = $this->details["firstname"] . " " . $this->details["lastname"];
        $internEmail = $this->details["email"];
        $message = <<<Message
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
          <style>
              body {
                 display: grid;
                 place-items: center;
                 width: 100%;
                 height: 100%;
                }
              h3 {
                color: #012a66;
              }
              .info {
                text-align: center;
              }
          </style>
        </head>
        
        <body>
 
        <div class="message">
            <h3> Dear $internName</h3>
           <div class="info">
           <h1> Thanks For Enrolling into the Klemweb Cohort Program </h1>
           </div>
        </div>
              
        </body>
        
        </html>

        Message;

        $details = [
            "internName" => $internName,
            "subject" => $subject,
            "internEmail" => $internEmail,
            "message" => $message
        ];

        (new Mailer($details))->sendMail();
    }
    public function sendTestCompletionMessage()
    {
        $subject = "Test Sucessfully Completed";
        $internName = $this->details["firstname"] . " " . $this->details["lastname"];
        $internEmail = $this->details["email"];
        $message = <<<Message
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
          <style>
              body {
                 display: grid;
                 place-items: center;
                 width: 100%;
                 height: 100%;
                }
              h3 {
                color: #012a66;
              }
              .info {
                text-align: center;
              }
          </style>
        </head>
        
        <body>
 
        <div class="message">
            <h3> Dear $internName</h3>
           <div class="info">
           <h1> Congratulations, you've Sucessfully completed the cohort test, wish you success all the way </h1>
           </div>
        </div>
              
        </body>
        
        </html>

        Message;

        $details = [
            "internName" => $internName,
            "subject" => $subject,
            "internEmail" => $internEmail,
            "message" => $message
        ];

        (new Mailer($details))->sendMail();
    }
}
