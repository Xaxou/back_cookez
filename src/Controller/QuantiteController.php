<?php

namespace App\Controller;

use App\Entity\Quantite;
use App\Form\QuantiteType;
use App\Repository\QuantiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quantite")
 */
class QuantiteController extends AbstractController
{
    /**
     * @Route("/", name="quantite_index", methods={"GET"})
     */
    public function index(QuantiteRepository $quantiteRepository): Response
    {
        return $this->render('quantite/index.html.twig', [
            'quantites' => $quantiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quantite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quantite = new Quantite();
        $form = $this->createForm(QuantiteType::class, $quantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quantite);
            $entityManager->flush();

            return $this->redirectToRoute('quantite_index');
        }

        return $this->render('quantite/new.html.twig', [
            'quantite' => $quantite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quantite_show", methods={"GET"})
     */
    public function show(Quantite $quantite): Response
    {
        return $this->render('quantite/show.html.twig', [
            'quantite' => $quantite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quantite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quantite $quantite): Response
    {
        $form = $this->createForm(QuantiteType::class, $quantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quantite_index');
        }

        return $this->render('quantite/edit.html.twig', [
            'quantite' => $quantite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quantite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quantite $quantite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quantite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quantite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quantite_index');
    }
}
