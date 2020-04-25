<?php

namespace App\Controller;

use App\Entity\Frigo;
use App\Form\FrigoType;
use App\Repository\FrigoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frigo")
 */
class FrigoController extends AbstractController
{
    /**
     * @Route("/", name="frigo_index", methods={"GET"})
     */
    public function index(FrigoRepository $frigoRepository): Response
    {
        return $this->render('frigo/index.html.twig', [
            'frigos' => $frigoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="frigo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $frigo = new Frigo();
        $form = $this->createForm(FrigoType::class, $frigo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($frigo);
            $entityManager->flush();

            return $this->redirectToRoute('frigo_index');
        }

        return $this->render('frigo/new.html.twig', [
            'frigo' => $frigo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frigo_show", methods={"GET"})
     */
    public function show(Frigo $frigo): Response
    {
        return $this->render('frigo/show.html.twig', [
            'frigo' => $frigo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frigo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Frigo $frigo): Response
    {
        $form = $this->createForm(FrigoType::class, $frigo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frigo_index');
        }

        return $this->render('frigo/edit.html.twig', [
            'frigo' => $frigo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frigo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Frigo $frigo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$frigo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($frigo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frigo_index');
    }
}
