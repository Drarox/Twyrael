<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Follow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserInterface $user)
    {
        $currentUser= $user->getId();
        $userName= $user->getUsername();

        //$em = $this->getDoctrine()->getManager();
        //$message = $em->getRepository(Messages::class)->findAll();

        $em = $this->getDoctrine ()->getManager ();
        $repository = $em->getRepository ( Messages::class);
        $result = $repository->findByUserId($currentUser);

//        $qb = $em->createQueryBuilder();
//
//        $qb->select('m')
//            ->from('Messages','m')
//            ->where('m.id_user_creation= :id')
//            ->setParameter('id', 1);
//
//        $query = $qb->getQuery();
//        $result = $query->getResult();

        print_r($result);
//        $array = $query->getArrayResult();

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
