<?php

namespace App\Repository;

use App\Entity\Referencer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Referencer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Referencer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Referencer[]    findAll()
 * @method Referencer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferencerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Referencer::class);
    }

    // /**
    //  * @return Referencer[] Returns an array of Referencer objects
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
    public function findOneBySomeField($value): ?Referencer
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
