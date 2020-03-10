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

        /**Pour chaque ingrédients
         * On récupère une liste de recettes
         * 
         * Ensuite on garde les recettes qui apparaissent sur tous les résultats
         */

        $recettespack = array();
        $result = null;
        $ingredients = [3,5];

        foreach($ingredients as $key => $value){
            $recettes = $this->createQueryBuilder('r')
            ->leftJoin('r.ingredients', 'ri')
            ->where('ri.id = :idingredient')
            ->setParameter(':idingredient', $value)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();

            if(sizeof($recettes) >0){
                array_push($recettespack, $recettes);
            }
        }
      
        foreach ($recettespack as $key => $value) {
            if($key > 0){
                $tab = $value;
                $result = array_intersect($tab, $result);
            }else{
                $result = $value;
            }
        } 

         return $result;
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
