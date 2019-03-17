<?php

namespace App\Controller;

use App\Entity\Diablo;
use App\Entity\HeroDiablo;
use App\Form\DiabloHeroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class DiabloController extends AbstractController
{
    /**
     * @Route("/diablo/create", name="diablo")
     */
    public function index(Request $request, UserInterface $user)
    {
        $hero = new HeroDiablo();
        $form = $this->createForm(DiabloHeroType::class, $hero);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $hero = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hero);
            $entityManager->flush();

            $diablo = new Diablo();
            $diablo->setBattleTag($hero->getBattleTag());
            $diablo->setIdUser($user->getId());
            $entityManager->persist($diablo);
            $entityManager->flush();

            echo "<script>alert('Profil créé!');</script>";
            return $this->redirectToRoute('home');
        }


            return $this->render('diablo/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/diablo/{id}", name="diabloprofil")
     */
    public function profil($id, Request $request)
    {
        $em = $this->getDoctrine ()->getManager ();
        $diablo = $em->getRepository ( Diablo::class)->find($id);
        print_r($diablo);

        return $this->render('diablo/profil.html.twig', [
            'result' => $diablo,
        ]);
    }
}
