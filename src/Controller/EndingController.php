<?php

namespace App\Controller;

use App\Entity\Ending;
use App\Form\EndingType;
use App\Repository\EndingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ending")
 */
class EndingController extends AbstractController
{
    /**
     * @Route("/", name="app_ending_index", methods={"GET"})
     */
    public function index(EndingRepository $endingRepository): Response
    {
        return $this->render('ending/index.html.twig', [
            'endings' => $endingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_ending_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EndingRepository $endingRepository): Response
    {
        $ending = new Ending();
        $form = $this->createForm(EndingType::class, $ending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $endingRepository->add($ending, true);

            $this->addFlash("create", "L'ending a bien été créé.");
            return $this->redirectToRoute('app_ending_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ending/new.html.twig', [
            'ending' => $ending,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ending_show", methods={"GET"})
     */
    public function show(Ending $ending): Response
    {
        return $this->render('ending/show.html.twig', [
            'ending' => $ending,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ending_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ending $ending, EndingRepository $endingRepository): Response
    {
        $form = $this->createForm(EndingType::class, $ending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $endingRepository->add($ending, true);

            $this->addFlash("edit", "L'ending a bien été édité.");
            return $this->redirectToRoute('app_ending_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ending/edit.html.twig', [
            'ending' => $ending,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ending_delete", methods={"POST"})
     */
    public function delete(Request $request, Ending $ending, EndingRepository $endingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ending->getId(), $request->request->get('_token'))) {
            $endingRepository->remove($ending, true);
        }
        $this->addFlash("delete", "L'ending a bien été effacé.");
        return $this->redirectToRoute('app_ending_index', [], Response::HTTP_SEE_OTHER);
    }
}
