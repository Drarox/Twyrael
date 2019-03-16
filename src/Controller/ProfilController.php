<?php

namespace App\Controller;

use App\Entity\Bloque;
use App\Entity\Follow;
use App\Form\ModifProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil")
     */
    public function index($id, UserInterface $user)
    {
        $currentUser= $user->getId();
        $em = $this->getDoctrine()->getManager ();
        $repository = $em->getRepository ( Utilisateur::class);
        $result = $repository->getUsername($id);

        $followrep = $em->getRepository ( Follow::class);
        $followresult = $followrep->alreadyExist($currentUser,$id);
        if ($followresult == null) { $alreadyFollow=false; } else { $alreadyFollow=true; }

        $blockrep = $em->getRepository ( Bloque::class);
        $blockresult = $blockrep->alreadyExist($currentUser,$id);
        if ($blockresult == null) { $alreadyBlock=false; } else { $alreadyBlock=true; }

        return $this->render('profil/profil.html.twig', [
            'result' => $result,
            'alreadyFollow' => $alreadyFollow,
            'alreadyBlock' => $alreadyBlock,
            'currentUser' => $currentUser,
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

        //return $this->redirectToRoute('profil/'.str($id));
        //echo "<script>history.go(-1);</script>";
        return $this->redirectToRoute('profil', array('id' => $id));
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

        return $this->redirectToRoute('profil', array('id' => $id));
    }

    /**
     * @Route("/unfollow/{id}", name="unfollow")
     */
    public function unfollow($id, UserInterface $user)
    {
        $currentUser= $user->getId();
        $em = $this->getDoctrine()->getManager ();

        $followrep = $em->getRepository ( Follow::class);
        $followresult = $followrep->alreadyExist($currentUser,$id);

        if ($followresult != null) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($followresult[0]);
            $entityManager->flush();
        }

        echo "<script>alert('Ce compte n\'est plus suivi');</script>";

        return $this->redirectToRoute('profil', array('id' => $id));
    }

    /**
     * @Route("/unblock/{id}", name="unblock")
     */
    public function unblock($id, UserInterface $user)
    {
        $currentUser= $user->getId();
        $em = $this->getDoctrine()->getManager ();

        $blockrep = $em->getRepository ( Bloque::class);
        $blockresult = $blockrep->alreadyExist($currentUser,$id);

        if ($blockresult != null) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blockresult[0]);
            $entityManager->flush();
        }

        echo "<script>alert('Ce compte n\'est plus bloqué');</script>";

        return $this->redirectToRoute('profil', array('id' => $id));
    }


}
