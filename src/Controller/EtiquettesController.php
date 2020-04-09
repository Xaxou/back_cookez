<?php

namespace App\Controller;

use App\Entity\Etiquettes;
use App\Form\EtiquettesType;
use App\Repository\EtiquettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etiquettes")
 */
class EtiquettesController extends AbstractController
{
    /**
     * @Route("/", name="etiquettes_index", methods={"GET"})
     */
    public function index(EtiquettesRepository $etiquettesRepository): Response
    {
        return $this->render('etiquettes/index.html.twig', [
            'etiquettes' => $etiquettesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etiquettes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etiquette = new Etiquettes();
        $form = $this->createForm(EtiquettesType::class, $etiquette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etiquette);
            $entityManager->flush();

            return $this->redirectToRoute('etiquettes_index');
        }

        return $this->render('etiquettes/new.html.twig', [
            'etiquette' => $etiquette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiquettes_show", methods={"GET"})
     */
    public function show(Etiquettes $etiquette): Response
    {
        return $this->render('etiquettes/show.html.twig', [
            'etiquette' => $etiquette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etiquettes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etiquettes $etiquette): Response
    {
        $form = $this->createForm(EtiquettesType::class, $etiquette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etiquettes_index');
        }

        return $this->render('etiquettes/edit.html.twig', [
            'etiquette' => $etiquette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiquettes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etiquettes $etiquette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etiquette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etiquette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etiquettes_index');
    }
}
