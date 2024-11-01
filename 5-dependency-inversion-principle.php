<?php
// Dependency Inversion Principle Violation
class Mailer
{

}

class SendWelcomeMessage
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}

// Refactored
interface Mailer
{
    public function send();
}

// Concrete implementation of Mailer using SMTP
class SmtpMailer implements Mailer
{
    public function send()
    {
        echo 'send message from SMTP mailer';
    }
}

// Concrete implementation of Mailer using SendGrid
class SendGridMailer implements Mailer
{
    public function send()
    {
        echo 'send message from SendGrid mailer';
    }
}

// High-level module that depends on the Mailer abstraction
class SendWelcomeMessage
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendWelcome()
    {
        $this->mailer->send();
    }
}

// Usage example
$smtpMailer = new SmtpMailer();
$welcomeMessage = new SendWelcomeMessage($smtpMailer);
$welcomeMessage->sendWelcome(); // Outputs: send message from SMTP mailer

$sendGridMailer = new SendGridMailer();
$welcomeMessage = new SendWelcomeMessage($sendGridMailer);
$welcomeMessage->sendWelcome(); // Outputs: send message from SendGrid mailer