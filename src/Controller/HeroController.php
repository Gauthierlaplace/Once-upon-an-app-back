<?php

namespace App\Controller;

use App\Entity\Hero;
use App\Form\HeroType;
use App\Repository\HeroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hero")
 */
class HeroController extends AbstractController
{
    /**
     * @Route("/", name="app_hero_index", methods={"GET"})
     */
    public function index(HeroRepository $heroRepository): Response
    {
        return $this->render('hero/index.html.twig', [
            'heroes' => $heroRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_hero_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HeroRepository $heroRepository): Response
    {
        $hero = new Hero();
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heroRepository->add($hero, true);

            return $this->redirectToRoute('app_hero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hero/new.html.twig', [
            'hero' => $hero,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hero_show", methods={"GET"})
     */
    public function show(Hero $hero): Response
    {
        $items = $hero->getItem()->toArray();
        

        return $this->render('hero/show.html.twig', [
            'hero' => $hero,
            'items' => $items
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hero_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hero $hero, HeroRepository $heroRepository): Response
    {
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $heroRepository->add($hero, true);

            return $this->redirectToRoute('app_hero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hero/edit.html.twig', [
            'hero' => $hero,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hero_delete", methods={"POST"})
     */
    public function delete(Request $request, Hero $hero, HeroRepository $heroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hero->getId(), $request->request->get('_token'))) {
            $heroRepository->remove($hero, true);
        }

        return $this->redirectToRoute('app_hero_index', [], Response::HTTP_SEE_OTHER);
    }
}
