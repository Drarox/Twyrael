<?php

namespace App\Repository;

use App\Entity\HeroDiablo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HeroDiablo|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroDiablo|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroDiablo[]    findAll()
 * @method HeroDiablo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroDiabloRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HeroDiablo::class);
    }

    // /**
    //  * @return HeroDiablo[] Returns an array of HeroDiablo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroDiablo
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
