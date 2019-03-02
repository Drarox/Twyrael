<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function index()
    {
        $currentUser= $this->getUser();
        $currentDateTime = new \DateTime();

        $message = new Messages();
        // On définit les options
        //$options = array('action' => $this->generateUrl('lpars_cours_formulaires_plus'));
        // Génération du formulaire
        $form = $this->createForm(MessageType::class, $message);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setDateCreation($currentDateTime);
            $message->setDateModif($currentDateTime);
            $message->setIdUserCreation($currentUser);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
        }

        return $this->render('messages/post.html.twig', array(
            'form' => $form->createView()));

//        return $this->render('messages/post.html.twig', [
//            'controller_name' => 'MessagesController',
//        ]);
    }

    public function getUserId()
    {
        return $this->getUser();
    }
}
