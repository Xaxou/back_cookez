<?php

namespace App\Controller;

use App\Entity\Etiquette;
use App\Form\EtiquetteType;
use App\Repository\EtiquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etiquette")
 */
class EtiquetteController extends AbstractController
{
    /**
     * @Route("/", name="etiquette_index", methods={"GET"})
     */
    public function index(EtiquetteRepository $etiquetteRepository): Response
    {
        return $this->render('etiquette/index.html.twig', [
            'etiquettes' => $etiquetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etiquette_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etiquette = new Etiquette();
        $form = $this->createForm(EtiquetteType::class, $etiquette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etiquette);
            $entityManager->flush();

            return $this->redirectToRoute('etiquette_index');
        }

        return $this->render('etiquette/new.html.twig', [
            'etiquette' => $etiquette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiquette_show", methods={"GET"})
     */
    public function show(Etiquette $etiquette): Response
    {
        return $this->render('etiquette/show.html.twig', [
            'etiquette' => $etiquette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etiquette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etiquette $etiquette): Response
    {
        $form = $this->createForm(EtiquetteType::class, $etiquette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etiquette_index');
        }

        return $this->render('etiquette/edit.html.twig', [
            'etiquette' => $etiquette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiquette_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etiquette $etiquette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etiquette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etiquette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etiquette_index');
    }
}
