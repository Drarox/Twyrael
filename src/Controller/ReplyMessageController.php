<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Reponse;
use App\Entity\Utilisateur;
use App\Form\ReplyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class ReplyMessageController extends AbstractController
{
    /**
     * @Route("/reply/{id}", name="reply_message")
     */
    public function index($id, Request $request, UserInterface $user)
    {
        $currentDateTime = new \DateTime();
        $currentUser= $user->getId();
        $em = $this->getDoctrine()->getManager ();
        $repositoryMessages = $em->getRepository ( Messages::class)->find($id);
        $pseudo = $em->getRepository ( Utilisateur::class)->getUsername($repositoryMessages);

        $reply = new Reponse();
        $form = $this->createForm(ReplyType::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reply = $form->getData();
            $reply->setIdMessage($repositoryMessages->getId());
            $reply->setDate($currentDateTime);
            $reply->setIdUserCreation($currentUser);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reply);
            $entityManager->flush();
            echo "<script>alert('Réponse posté!');</script>";
            return $this->redirectToRoute('home');
        }

        return $this->render('reply_message/reply.html.twig', [
            'message' => $repositoryMessages,
            'form' => $form->createView(),
            'pseudo' => $pseudo,
        ]);
    }
}
