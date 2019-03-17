<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function getUsername($id)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where('u.id= :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getID($pseudo)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where('u.pseudo = :pseudo')
            ->setParameter('pseudo', $pseudo);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getMemberList()
    {
        $qb = $this->createQueryBuilder('m');

        $qb->where('1=1');

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Utilisateur[] Returns an array of Utilisateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Utilisateur
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
