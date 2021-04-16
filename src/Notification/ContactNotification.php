<?php
namespace App\Notification;

use App\Entity\Contact;
use Monolog\Handler\SwiftMailerHandler;
use Twig\Environment;

class ContactNotification  
{
    private $mailer;

    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('360RealEstate: ' . $contact->getProperty()->getTitle()))
            ->setFrom('noreply@360realestate.com')
            ->setTo('contact@agency.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }   
}
