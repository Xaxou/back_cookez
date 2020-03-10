<?php

namespace App\Repository;

use App\Entity\Etiquettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Etiquettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etiquettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etiquettes[]    findAll()
 * @method Etiquettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtiquettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etiquettes::class);
    }

    // /**
    //  * @return Etiquettes[] Returns an array of Etiquettes objects
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
    public function findOneBySomeField($value): ?Etiquettes
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
