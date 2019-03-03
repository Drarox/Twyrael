<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(UserInterface $user)
    {
        $currentUser= $user->getId();
        $userName= $user->getUsername();

        //query :
//      use twyrael;
//      select messages.* from messages where messages.id_user_creation = 1
//      union
//      select messages.* from messages, follow where messages.id_user_creation = follow.id_user2 and follow.id_user1 = 1


        return $this->render('home/home.html.twig', [
            'username' => $userName,
        ]);
    }
}
