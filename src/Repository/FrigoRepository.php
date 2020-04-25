<?php

namespace App\Repository;

use App\Entity\Frigo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Frigo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frigo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frigo[]    findAll()
 * @method Frigo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrigoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frigo::class);
    }

    // /**
    //  * @return Frigo[] Returns an array of Frigo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Frigo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
