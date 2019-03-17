<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Follow;
use App\Entity\Reponse;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserInterface $user)
    {
        $currentUser= $user->getId();
        $username= $this->getUsernameById($currentUser);
//        print_r($user);

        //$em = $this->getDoctrine()->getManager();
        //$message = $em->getRepository(Messages::class)->findAll();

        $em = $this->getDoctrine ()->getManager ();
//        $repository = $em->getRepository ( Messages::class);
//        $result = $repository->findByUserId($currentUser);

        $RAW_QUERY = '
select messages.*, utilisateur.pseudo from messages left outer join utilisateur on utilisateur.id=messages.id_user_creation where messages.id_user_creation = :id
union 
select messages.*, utilisateur.pseudo from messages, follow, utilisateur where messages.id_user_creation = follow.id_user2 and utilisateur.id=messages.id_user_creation and follow.id_user1 = :id       
        ';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->bindValue('id', $currentUser);
        $statement->execute();

        $result = $statement->fetchAll();
        rsort($result);
        //print_r($result);

        $reply = array();
        $test = array();
        foreach ($result as $mess) {
            $replyRes = $em->getRepository(Reponse::class)->findByMessageId($mess['id']);
            if ($replyRes != null) {
                $pseudo = $em->getRepository ( Utilisateur::class)->getUsername($replyRes[0]->getIdUserCreation());
                $test[0] =$replyRes;
                $test[1] =$pseudo[0]->getPseudo();
                array_push($reply, $test);
            }
        }

//        $qb = $em->createQueryBuilder();
//
//        $qb->select('m')
//            ->from('Messages','m')
//            ->where('m.id_user_creation= :id')
//            ->setParameter('id', 1);
//
//        $query = $qb->getQuery();
//        $result = $query->getResult();

        //print_r($result);
//        $array = $query->getArrayResult();

        //query :
//    use twyrael;
//        select messages.*, utilisateur.pseudo from messages left outer join utilisateur on utilisateur.id=messages.id_user_creation where messages.id_user_creation = 1
//union
//select messages.*, utilisateur.pseudo from messages, follow, utilisateur where messages.id_user_creation = follow.id_user2 and utilisateur.id=messages.id_user_creation and follow.id_user1 = 1




        return $this->render('home/home.html.twig', [
            'user' => $username,
            'result' => $result,
            'reply' => $reply,
        ]);
    }

    public function getUsernameById($id)
    {
        $em = $this->getDoctrine()->getManager ();
        $repository = $em->getRepository ( Utilisateur::class);
        $result = $repository->getUsername($id);
        return $result;
    }


}
