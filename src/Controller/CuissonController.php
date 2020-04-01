<?php

namespace App\Controller;

use App\Entity\Cuisson;
use App\Form\CuissonType;
use App\Repository\CuissonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cuisson")
 */
class CuissonController extends AbstractController
{
    /**
     * @Route("/", name="cuisson_index", methods={"GET"})
     */
    public function index(CuissonRepository $cuissonRepository): Response
    {
        return $this->render('cuisson/index.html.twig', [
            'cuissons' => $cuissonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cuisson_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cuisson = new Cuisson();
        $form = $this->createForm(CuissonType::class, $cuisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuisson);
            $entityManager->flush();

            return $this->redirectToRoute('cuisson_index');
        }

        return $this->render('cuisson/new.html.twig', [
            'cuisson' => $cuisson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuisson_show", methods={"GET"})
     */
    public function show(Cuisson $cuisson): Response
    {
        return $this->render('cuisson/show.html.twig', [
            'cuisson' => $cuisson,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cuisson_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cuisson $cuisson): Response
    {
        $form = $this->createForm(CuissonType::class, $cuisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cuisson_index');
        }

        return $this->render('cuisson/edit.html.twig', [
            'cuisson' => $cuisson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuisson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cuisson $cuisson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuisson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cuisson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cuisson_index');
    }
}
