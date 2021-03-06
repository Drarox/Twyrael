<?php

namespace App\Repository;

use App\Entity\Bloque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bloque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bloque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bloque[]    findAll()
 * @method Bloque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloqueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bloque::class);
    }

    public function alreadyExist($id1, $id2)
    {
        $qb = $this->createQueryBuilder('b');

        $qb->where('b.idUser1 = :id1')
            ->setParameter('id1', $id1)
            ->andWhere('b.idUser2 = :id2')
            ->setParameter('id2', $id2);

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Bloque[] Returns an array of Bloque objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bloque
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
