<?php

namespace App\Repository;

use App\Entity\Diablo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Diablo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diablo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diablo[]    findAll()
 * @method Diablo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiabloRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Diablo::class);
    }

    // /**
    //  * @return Diablo[] Returns an array of Diablo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diablo
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
