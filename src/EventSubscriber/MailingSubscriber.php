<?php

namespace App\EventSubscriber;

use App\Message\EmailMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;

class MailingSubscriber implements EventSubscriberInterface
{
    public function __construct(protected MessageBusInterface $bus) // private readonly MailerInterface $mailer,
    {
    }

    public function onContactRequestEvent(ContactRequestEvent $event): void
    {
        $data = $event->data;
        //$email = new EmailMessage($data->name, $data->email, $data->message);
       /* $email = (new Email())
            ->from($data->email)
            ->to('contact@event.com')
            ->subject('Demande de contact')
            ->text($data->message);
            //->html('<p>See Twig integration for better HTML integration!</p>');*/

        $this->bus->dispatch(new EmailMessage('Look! I created a message!'));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRequestEvent::class => 'onContactRequestEvent',
        ];
    }
}
