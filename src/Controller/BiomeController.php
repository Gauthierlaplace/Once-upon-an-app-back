<?php

namespace App\Controller;

use App\Entity\Biome;
use App\Form\BiomeType;
use App\Repository\BiomeRepository;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Services\PaginatorService;
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
    public function index(BiomeRepository $biomeRepository, PaginatorService $paginatorService): Response
    {
        $biomesToPaginate = $biomeRepository->findBy([],['name' => 'ASC']);
        $biomesPaginated = $paginatorService->paginator($biomesToPaginate, 10);
        return $this->render('biome/index.html.twig', [
            'biomes' => $biomesPaginated,
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

            $this->addFlash("create", "Le biome a bien été créé.");
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

            $this->addFlash("edit", "Le biome a bien été édité.");
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
    public function delete($id, Request $request, Biome $biome, BiomeRepository $biomeRepository, EventRepository $eventRepository, EndingRepository $endingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biome->getId(), $request->request->get('_token'))) {
            
            $allEvents = $eventRepository->findByBiome($id);
    
            foreach ($allEvents as $event) {
                $eventId = $event->getId();
                $allEndings = $endingRepository->findByEvent($eventId);
                foreach ($allEndings as $ending) {
                    $endingRepository->remove($ending);
                }


                $eventRepository->remove($event);
            }
            
            $biomeRepository->remove($biome, true);
        }
        $this->addFlash("delete", "Le biome a bien été effacé.");
        return $this->redirectToRoute('app_biome_index', [], Response::HTTP_SEE_OTHER);
    }
}
