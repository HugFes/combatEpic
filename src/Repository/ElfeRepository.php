<?php

namespace App\Repository;

use App\Entity\Elfe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Elfe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Elfe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Elfe[]    findAll()
 * @method Elfe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElfeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Elfe::class);
    }

    // /**
    //  * @return Elfe[] Returns an array of Elfe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Elfe
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
