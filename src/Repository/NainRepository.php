<?php

namespace App\Repository;

use App\Entity\Nain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nain|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nain|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nain[]    findAll()
 * @method Nain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nain::class);
    }

    // /**
    //  * @return Nain[] Returns an array of Nain objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nain
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
