<?php

namespace App\Controller;


use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MembersController extends AbstractController
{
    /**
     * @Route("/members", name="members")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager ();
        $repositoryMessages = $em->getRepository ( Utilisateur::class);
        $result = $repositoryMessages->getMemberList();

        return $this->render('members/members.html.twig', [
            'result' => $result,
        ]);
    }
}
