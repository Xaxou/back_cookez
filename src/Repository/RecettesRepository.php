<?php

namespace App\Repository;

use App\Entity\Recettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recettes[]    findAll()
 * @method Recettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recettes::class);
    }

     /**
      * @return Recettes[] Returns an array of Recettes objects
      */
    
    public function findByIngredients($ingredients)
    {
        return $this->createQueryBuilder('recettes')
            ->where('recettes.id = :id')
            ->leftJoin('recettes.ingredients', 'ri')
            ->setParameter('id', '1')
            ->orderBy('recettes.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    

    /*
    public function findOneBySomeField($value): ?Recettes
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
