<?php 
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactNotification {

  /**
   * @var \Swift_Mailer
   */
  public function __construct(MailerInterface $mailer, Environment $renderer)
  {
    $this->mailer = $mailer;
    $this->renderer = $renderer;
  }

  /**
   * 
   */
  public function notify(Contact $contact)
  {
    $message = (new Email())
      ->from('noreply@agency.com')
      ->to('contact@agency.com')
      ->replyTo($contact->getMail())
      ->subject('A new mail from your agency')
      ->html($this->renderer->render('emails/contact.html.twig', [
        'contact' => $contact
      ]), 'text/html');
    $this->mailer->send($message);
  }
}


?>