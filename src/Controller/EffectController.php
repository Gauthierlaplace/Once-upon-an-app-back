<?php

namespace App\Controller;

use App\Entity\Effect;
use App\Form\EffectType;
use App\Repository\EffectRepository;
use App\Services\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/effect")
 */
class EffectController extends AbstractController
{
    /**
     * @Route("/", name="app_effect_index", methods={"GET"})
     */
    public function index(EffectRepository $effectRepository, PaginatorService $paginatorService): Response
    {
        $effectsToPaginate = $effectRepository->findBy([],['name' => 'ASC']);
        $effectsPaginated = $paginatorService->paginator($effectsToPaginate, 10);
        return $this->render('effect/index.html.twig', [
            'effects' => $effectsPaginated,
        ]);
    }

    /**
     * @Route("/new", name="app_effect_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EffectRepository $effectRepository): Response
    {
        $effect = new Effect();
        $form = $this->createForm(EffectType::class, $effect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $effectRepository->add($effect, true);

            $this->addFlash("create", "L'effet a bien été créé.");
            return $this->redirectToRoute('app_effect_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('effect/new.html.twig', [
            'effect' => $effect,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_effect_show", methods={"GET"})
     */
    public function show(Effect $effect): Response
    {
        return $this->render('effect/show.html.twig', [
            'effect' => $effect,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_effect_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Effect $effect, EffectRepository $effectRepository): Response
    {
        $form = $this->createForm(EffectType::class, $effect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $effectRepository->add($effect, true);

            $this->addFlash("edit", "L'effet a bien été édité.");
            return $this->redirectToRoute('app_effect_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('effect/edit.html.twig', [
            'effect' => $effect,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_effect_delete", methods={"POST"})
     */
    public function delete(Request $request, Effect $effect, EffectRepository $effectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$effect->getId(), $request->request->get('_token'))) {
            $effectRepository->remove($effect, true);
        }
        $this->addFlash("delete", "L'effet a bien été effacé.");
        return $this->redirectToRoute('app_effect_index', [], Response::HTTP_SEE_OTHER);
    }
}
