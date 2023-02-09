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
    $subject = "Connfirm Registration";
    $internName = $this->details["firstname"] . " " . $this->details["lastname"];
    $internEmail = $this->details["email"];
    $root = $_SERVER["DOCUMENT_ROOT"];
    $image = $root . "/assets/images/logo.png";
    $message = <<<Message
        <!DOCTYPE html>
        <html lang="en">
          <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <meta name="description" content="">
              <style>
              *{
                box-sizing: border-box;
                marging: 0;
                padding: 0;
              }
              body {
                width: 100%;
                overflow-x: hidden;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 1.2rem;
            }

            #message {
                max-width: 30rem;
                width: 100%;
                margin: auto;
            }

            #message h3 {
                color: #012a66;
            }

            #message>a {
                all: unset;
                background: #012a66;
                color: #fff;
                font-size: 1.2rem;
                padding: 0.6em;
                cursor: pointer;
                text-decoration: none;
                border-radius: .2rem;
                display: block;
                transition: .5s linear;
                margin: auto;
                margin-top: .8rem;
                width: max-content;
            }

            #message>a:hover {
                background: #012a6699;
            }

            .foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                margin-top: 1rem;
                padding-top: 2rem;
                border-top: 1px solid grey;
            }

            .foot img {
                width: 4rem;
                aspect-ratio: 1/1;
            }

            .foot .contact {
              margin-left: 1.5rem;
            }

            .foot a {
                all: unset;
                text-decoration: none;
                color: #012a66;
                margin: 1.2rem 0;
                display: block;
                cursor: pointer;
            }
              </style>
          </head>

          <body>
              <section id="message">
                  <h3> Hello $internName </h3>
                  <p>
                      We are happy to inform you that we have received your application.
                      Please bear in mind that this is not the end of the process and
                      there are still a few more stages to go through.
                  </p>
                  <p>
                      Please, click the button below to start your test.
                  </p>
                  <a href="https://www.cohort.klemweb.com/login.php">Online Test</a>
                  <div class="foot">
                  <div class="company">
                      <img src="$image" alt="">
                      
                      <p>
                          Suit 3, Farmer's care, Opp, Adekaitan Petrol Station, Ojongbodu, iseyin, Road, Oyo State
                      </p>
                  </div>
                  <div class="contact">
                      <a href="mailto:admissions@klemweb.com">Admissions@klemweb.com</a>
                      <a href="tel:08136528369">08136528369</a>
                  </div>
              </div>
              </section>

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
    $root = $_SERVER["DOCUMENT_ROOT"];
    $image = $root . "/assets/images/logo.png";
    $message = <<<Message
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
          <style>
              body {
                width: 100%;
                overflow-x: hidden;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 1.2rem;
            }

            #message {
                width: 30rem;
                margin: auto;
            }

            #message h3 {
                color: #012a66;
            }

            #message>a {
                all: unset;
                background: #012a66;
                color: #fff;
                font-size: 1.2rem;
                padding: 0.6em;
                float: right;
                cursor: pointer;
                text-decoration: none;
                border-radius: .2rem;
                transition: .5s linear;
                margin: auto;
            }

            #message>a:hover {
                background: #012a6699;
            }

            .foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                margin-top: 8rem;
                padding-top: 2rem;
                border-top: 1px solid grey;
            }

            .foot img {
                width: 4rem;
                aspect-ratio: 1/1;
            }

            .foot .contact {
              margin-left: 1.5rem;
            }

            .foot a {
                all: unset;
                text-decoration: none;
                color: #012a66;
                margin: 1.2rem 0;
                display: block;
                cursor: pointer;
            }
              </style>
          </head>

          <body>
              <section id="message">
                  <h3> Hello $internName </h3>
                  <p>
                    Thank you for completing your online test.
                    The Klemweb Admission Team will get back to you in due time
                  </p>
                  <p>
                    The Klemweb Admission Team will get back to you in due time
                  </p>
                  <p>
                    Warm Regards <br/>
                    Klemweb Admission Team
                  </p>
                  <div class="foot">
                  <div class="company">
                      <img src="$image" alt="">
                      <p>
                          Suit 3, Farmer's care, Opp, Adekaitan Petrol Station, Ojongbodu, iseyin, Road, Oyo State
                      </p>
                  </div>
                  <div class="contact">
                      <a href="mailto:admissions@klemweb.com">Admissions@klemweb.com</a>
                      <a href="tel:08136528369">08136528369</a>
                  </div>
              </div>
              </section>

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