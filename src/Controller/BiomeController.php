<?php

namespace App\Controller;

use App\Entity\Biome;
use App\Form\BiomeType;
use App\Repository\BiomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/biome")
 */
class BiomeController extends AbstractController
{
    /**
     * @Route("/", name="app_biome_index", methods={"GET"})
     */
    public function index(BiomeRepository $biomeRepository): Response
    {
        return $this->render('biome/index.html.twig', [
            'biomes' => $biomeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_biome_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BiomeRepository $biomeRepository): Response
    {
        $biome = new Biome();
        $form = $this->createForm(BiomeType::class, $biome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biomeRepository->add($biome, true);

            return $this->redirectToRoute('app_biome_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biome/new.html.twig', [
            'biome' => $biome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biome_show", methods={"GET"})
     */
    public function show(Biome $biome): Response
    {
        return $this->render('biome/show.html.twig', [
            'biome' => $biome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_biome_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Biome $biome, BiomeRepository $biomeRepository): Response
    {
        $form = $this->createForm(BiomeType::class, $biome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biomeRepository->add($biome, true);

            return $this->redirectToRoute('app_biome_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biome/edit.html.twig', [
            'biome' => $biome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biome_delete", methods={"POST"})
     */
    public function delete(Request $request, Biome $biome, BiomeRepository $biomeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biome->getId(), $request->request->get('_token'))) {
            $biomeRepository->remove($biome, true);
        }

        return $this->redirectToRoute('app_biome_index', [], Response::HTTP_SEE_OTHER);
    }
}
