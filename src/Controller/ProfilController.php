<?php

namespace App\Controller;

use App\Entity\Bloque;
use App\Entity\Follow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="use Symfony\Component\Security\Core\User\UserInterface;profil")
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager ();
        $repository = $em->getRepository ( Utilisateur::class);
        $result = $repository->getUsername($id);


        return $this->render('profil/profil.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/follow/{id}", name="follow")
     */
    public function follow($id, UserInterface $user)
    {
        $currentUser= $user->getId();

        $follow = new Follow();
        $follow->setIdUser1($currentUser);
        $follow->setIdUser2($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($follow);
        $entityManager->flush();

        echo "<script>alert('Compte suivi');</script>";

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/block/{id}", name="block")
     */
    public function block($id, UserInterface $user)
    {
        $currentUser= $user->getId();

        $bloque = new Bloque();
        $bloque->setIdUser1($currentUser);
        $bloque->setIdUser2($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($bloque);
        $entityManager->flush();

        echo "<script>alert('Compte bloqué');</script>";

        return $this->redirectToRoute('home');
    }
}
