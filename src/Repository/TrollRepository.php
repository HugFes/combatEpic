<?php

namespace App\Repository;

use App\Entity\Troll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Troll|null find($id, $lockMode = null, $lockVersion = null)
 * @method Troll|null findOneBy(array $criteria, array $orderBy = null)
 * @method Troll[]    findAll()
 * @method Troll[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrollRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Troll::class);
    }

    // /**
    //  * @return Troll[] Returns an array of Troll objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Troll
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
