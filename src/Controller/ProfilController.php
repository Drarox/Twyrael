<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil")
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
}
