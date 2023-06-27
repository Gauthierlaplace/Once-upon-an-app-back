<?php

namespace App\Controller;

use App\Entity\EventType;
use App\Form\EventTypeType;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Services\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event-type")
 */
class EventTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_event_type_index", methods={"GET"})
     */
    public function index(EventTypeRepository $eventTypeRepository, PaginatorService $paginatorService): Response
    {
        $eventTypesToPaginate = $eventTypeRepository->findBy([],['name' => 'ASC']);
        $eventTypesPaginated = $paginatorService->paginator($eventTypesToPaginate, 10);
        return $this->render('event_type/index.html.twig', [
            'event_types' => $eventTypesPaginated,
        ]);
    }

    /**
     * @Route("/new", name="app_event_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EventTypeRepository $eventTypeRepository): Response
    {
        $eventType = new EventType();
        $form = $this->createForm(EventTypeType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventTypeRepository->add($eventType, true);

            $this->addFlash("create", "Le type d'événement a bien été créé.");
            return $this->redirectToRoute('app_event_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_type/new.html.twig', [
            'event_type' => $eventType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_type_show", methods={"GET"})
     */
    public function show(EventType $eventType): Response
    {
        return $this->render('event_type/show.html.twig', [
            'event_type' => $eventType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_event_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EventType $eventType, EventTypeRepository $eventTypeRepository): Response
    {
        $form = $this->createForm(EventTypeType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventTypeRepository->add($eventType, true);

            $this->addFlash("edit", "Le type d'événement a bien été édité.");
            return $this->redirectToRoute('app_event_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_type/edit.html.twig', [
            'event_type' => $eventType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_type_delete", methods={"POST"})
     */
    public function delete($id, Request $request, EventType $eventType, EventTypeRepository $eventTypeRepository, EventRepository $eventRepository, EndingRepository $endingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventType->getId(), $request->request->get('_token'))) {

            $allEvents = $eventRepository->findByEventType($id);
    
            foreach ($allEvents as $event) {
                $eventId = $event->getId();
                $allEndings = $endingRepository->findByEvent($eventId);
    
            foreach ($allEndings as $ending) {
                $endingRepository->remove($ending);
            }
                $eventRepository->remove($event);
            }
            $eventTypeRepository->remove($eventType, true);
        }
        $this->addFlash("delete", "Le type d'événement a bien été effacé.");
        return $this->redirectToRoute('app_event_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
