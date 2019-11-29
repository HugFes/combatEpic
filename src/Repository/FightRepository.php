<?php

namespace App\Repository;

use App\Entity\Fight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Fight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fight[]    findAll()
 * @method Fight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fight::class);
    }



}
