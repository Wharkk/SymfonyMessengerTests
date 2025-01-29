<?php

namespace App\MessageHandler;

use App\Message\EmailMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class EmailMessageHandler
{
    public function __construct(private readonly MailerInterface $mailer){

    }

    public function __invoke(EmailMessage $message): void
    {
        // ... do some work - like sending a message!
        $email = (new Email());
        $email->from('test@event.com');
        $email->to('support@event.com');
        $email->subject('Demande de contact');
        $email->text($message->getContent());
        $this->mailer->send($email);
    }
}