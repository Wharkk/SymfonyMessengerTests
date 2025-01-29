<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\EventSubscriber\ContactRequestEvent;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, EventDispatcherInterface $dispatcher): Response
    {
        $data = new ContactDTO();
        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $dispatcher->dispatch(new ContactRequestEvent($data));
                $this->addFlash('success', 'Votre email a bien été envoyé');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Impossible d\'envoyer votre email');
            }
        }
        return $this->render('contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
