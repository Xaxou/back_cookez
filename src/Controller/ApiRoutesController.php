<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\RecettesRepository;


class ApiRoutesController extends AbstractController
{
    /**
     * @Route("/api/routes", name="api_routes")
     */
    public function index()
    {
        return $this->render('api_routes/index.html.twig', [
            'controller_name' => 'ApiRoutesController',
        ]);
    }

    /**
     * @Route(
     *      "/byingredients",
     *      name="recettes_by_ingredients",
     *      methods={"GET"},
     *      defaults={
     *         "_api_resource_class"=Recettes::class,
     *         "_api_item_operation_name"="recettes_ingredients"
     *      } 
     *  )
     */
    
    public function recettesByIngredients(RecettesRepository $recettesRepository): Array
    {
       $recettes = $recettesRepository->findByIngredients('2,3');
       return $recettes;   
    }
}
