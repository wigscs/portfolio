<?php

namespace App;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ContactMailer
{
    /**
     * PHPMailer
     *
     * @var PHPMailer
     */
    protected $mail;

    public function __construct()
    {
        $exceptions = $_ENV['EMAIL_DEBUG'];
        $mail = new PHPMailer($exceptions);
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $this->mail = $mail;
    }

    public function send(array $input)
    {
        $this->mail->setFrom('enquiry@demomailtrap.com', "{$input['first_name']} {$input['last_name']}");
        $this->mail->addAddress($_ENV['ADMIN_EMAIL'], 'Portfolio Enquiry');
        $this->mail->Subject = $input['subject'];
        
        $body = "<h1>Portfolio Enquiry</h1>".PHP_EOL;
        $body .= "<ul>".PHP_EOL;
        $body .= "<li><strong>Name:</strong> {$input['first_name']} {$input['last_name']}</li>".PHP_EOL;
        $body .= "<li><strong>Email:</strong> {$input['email']}</li>".PHP_EOL;
        $body .= "<li><strong>Phone:</strong> {$input['phone']}</li>".PHP_EOL;
        $body .= "</ul>".PHP_EOL;
        $body .= "<h2>{$input['subject']}</h2>".PHP_EOL;
        $body .= "<p>".nl2br($input['message'])."</p>".PHP_EOL;

        // Set HTML 
        $this->mail->isHTML(true);
        $this->mail->Body = $body;
        $this->mail->AltBody = strip_tags($body);

        // send the message
        if (!$this->mail->send()){
            throw new Exception('Message could not be sent.'.PHP_EOL.'Mailer Error: ' . $this->mail->ErrorInfo);
        }

        return true;
    }

}