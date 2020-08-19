<?php

namespace App\Repository;

use App\Entity\Visiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiter[]    findAll()
 * @method Visiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visiter::class);
    }

    // /**
    //  * @return Visiter[] Returns an array of Visiter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visiter
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
