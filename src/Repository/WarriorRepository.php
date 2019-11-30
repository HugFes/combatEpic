<?php

namespace App\Repository;

use App\Entity\Warrior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Warrior|null find($id, $lockMode = null, $lockVersion = null)
 * @method Warrior|null findOneBy(array $criteria, array $orderBy = null)
 * @method Warrior[]    findAll()
 * @method Warrior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarriorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Warrior::class);
    }

    /**
     * @return mixed
     */
    public function getWarriorAlive(){
        $warriors = $this->createQueryBuilder("c")
            ->where("c.deathDate is Null")
            ->andWhere("c.pv > 0")
            ->getQuery()
            ->getResult();

        return $warriors;
    }

    public function findBySlug($slug)
    {
        return $this->createQueryBuilder("w")
            ->where("w.slug = :slug")
            ->setParameter("slug", $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }


}
