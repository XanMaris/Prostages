<?php

namespace App\Controller;

use App\Entity\Fomration;
use App\Form\FomrationType;
use App\Repository\FomrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fomration")
 */
class FomrationController extends AbstractController
{
    /**
     * @Route("/", name="fomration_index", methods={"GET"})
     */
    public function index(FomrationRepository $fomrationRepository): Response
    {
        return $this->render('fomration/index.html.twig', [
            'fomrations' => $fomrationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fomration_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fomration = new Fomration();
        $form = $this->createForm(FomrationType::class, $fomration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fomration);
            $entityManager->flush();

            return $this->redirectToRoute('fomration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fomration/new.html.twig', [
            'fomration' => $fomration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fomration_show", methods={"GET"})
     */
    public function show(Fomration $fomration): Response
    {
        return $this->render('fomration/show.html.twig', [
            'fomration' => $fomration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fomration_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Fomration $fomration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FomrationType::class, $fomration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('fomration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fomration/edit.html.twig', [
            'fomration' => $fomration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fomration_delete", methods={"POST"})
     */
    public function delete(Request $request, Fomration $fomration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fomration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fomration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fomration_index', [], Response::HTTP_SEE_OTHER);
    }
}
