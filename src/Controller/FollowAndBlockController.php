<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Utilisateur;

class FollowAndBlockController extends AbstractController
{
    /**
     * @Route("/followandblock/{id}", name="follow_and_block")
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager ();
        $repository = $em->getRepository ( Utilisateur::class);
        $currentusername = $repository->getUsername($id);

        $em = $this->getDoctrine ()->getManager ();

        $RAW_QUERY1 = 'select utilisateur.pseudo, utilisateur.id from utilisateur, follow where utilisateur.id=follow.id_user2 and follow.id_user1= :id';
        $RAW_QUERY2 = 'select utilisateur.pseudo, utilisateur.id from utilisateur, bloque where utilisateur.id=bloque.id_user2 and bloque.id_user1= :id';
        $RAW_QUERY3 = 'select utilisateur.pseudo, utilisateur.id from utilisateur, follow where utilisateur.id=follow.id_user1 and follow.id_user2= :id';
        $RAW_QUERY4 = 'select utilisateur.pseudo, utilisateur.id from utilisateur, bloque where utilisateur.id=bloque.id_user1 and bloque.id_user2= :id';

        $statement = $em->getConnection()->prepare($RAW_QUERY1);
        $statement->bindValue('id', $id);
        $statement->execute();
        $resultFollow = $statement->fetchAll();

        $statement = $em->getConnection()->prepare($RAW_QUERY2);
        $statement->bindValue('id', $id);
        $statement->execute();
        $resultBlock = $statement->fetchAll();

        $statement = $em->getConnection()->prepare($RAW_QUERY3);
        $statement->bindValue('id', $id);
        $statement->execute();
        $resultBeFollow = $statement->fetchAll();

        $statement = $em->getConnection()->prepare($RAW_QUERY4);
        $statement->bindValue('id', $id);
        $statement->execute();
        $resultBeBlock = $statement->fetchAll();


        return $this->render('follow_and_block/followandblock.html.twig', [
            'resultFollow' => $resultFollow,
            'resultBlock' => $resultBlock,
            'currentusername' => $currentusername,
            'resultBeFollow' => $resultBeFollow,
            'resultBeBlock' => $resultBeBlock,
        ]);
    }


}
