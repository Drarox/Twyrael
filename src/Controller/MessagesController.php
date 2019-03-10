<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Security\Core\User\UserInterface;


class MessagesController extends AbstractController
{
    /**
     * @Route("/postamessage", name="messages")
     */
    public function index(Request $request, UserInterface $user)
    {
        $currentUser= $user->getId();
        $currentDateTime = new \DateTime();

        $message = new Messages();
        // On définit les options
        //$options = array('action' => $this->generateUrl('lpars_cours_formulaires_plus'));
        // Génération du formulaire

        $message->setDateCreation($currentDateTime);
        $message->setDateModif($currentDateTime);
        $message->setIdUserCreation($currentUser);

        $form = $this->createForm(MessageType::class, $message);

//        $form = $this->createFormBuilder($message)
//            ->add('contenu', TextareaType::class, [
//                'required' => true,
//                'label' => ' '
//            ])
//            ->getForm();

        $form->handleRequest($request);


           if ($form->isSubmitted() && $form->isValid()) {
               $message = $form->getData();
               $message->setDateCreation($currentDateTime);
               $message->setDateModif($currentDateTime);
               $message->setIdUserCreation($currentUser);

               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($message);
               $entityManager->flush();
               echo "<script>alert('Message posté!');</script>";
               return $this->redirectToRoute('home');
           }


        return $this->render('messages/post.html.twig', array(
            'form' => $form->createView()));

//        return $this->render('messages/post.html.twig', [
//            'controller_name' => 'MessagesController',
//        ]);
    }
}
