<?php

namespace App\Repository;

use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function findByMessageId($id)
    {
        $qb = $this->createQueryBuilder('r');

        $qb->where('r.idMessage= :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Reponse[] Returns an array of Reponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reponse
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
