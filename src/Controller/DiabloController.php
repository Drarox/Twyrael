<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DiabloController extends AbstractController
{
    /**
     * @Route("/diablo", name="diablo")
     */
    public function index()
    {
        return $this->render('diablo/index.html.twig', [
            'controller_name' => 'DiabloController',
        ]);
    }
}
