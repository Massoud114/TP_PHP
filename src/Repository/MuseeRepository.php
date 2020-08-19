<?php

namespace App\Repository;

use App\Entity\Musee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Musee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Musee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Musee[]    findAll()
 * @method Musee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Musee::class);
    }

    // /**
    //  * @return Musee[] Returns an array of Musee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Musee
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
