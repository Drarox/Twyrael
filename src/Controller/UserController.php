<?php

namespace App\Controller;

use App\Entity\Bloque;
use App\Entity\Follow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Entity\Messages;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user")
     */
    public function index($id,  UserInterface $user)
    {
        $currentUser= $user->getId();
        $em = $this->getDoctrine()->getManager ();
        $repositoryUtilisateur = $em->getRepository ( Utilisateur::class);
        $userid = $repositoryUtilisateur->getID($id);

        $repositoryMessages = $em->getRepository ( Messages::class);
        $result = $repositoryMessages->findByUserId($userid[0]);
        rsort($result);

        $followrep = $em->getRepository ( Follow::class);
        $followresult = $followrep->alreadyExist($currentUser,$id);
        if ($followresult == null) { $alreadyFollow=false; } else { $alreadyFollow=true; }

        $blockrep = $em->getRepository ( Bloque::class);
        $blockresult = $blockrep->alreadyExist($currentUser,$id);
        if ($blockresult == null) { $alreadyBlock=false; } else { $alreadyBlock=true; }

        return $this->render('user/user.html.twig', [
            'result' => $result,
            'user' => $userid,
            'alreadyFollow' => $alreadyFollow,
            'alreadyBlock' => $alreadyBlock,
        ]);
    }
}
