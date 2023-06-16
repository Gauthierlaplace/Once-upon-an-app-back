<?php

namespace App\Controller\api;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends CoreApiController
{
    /**
     * @Route("/api/play", name="app_api_game" , methods={"GET"})
     */
    public function btnPlay(
        EventRepository $eventRepository
    ): JsonResponse {
        // Arrivée Event Départ du Biome 1 , 1er noeud de choix d'ending
        // un random EventA Départ + opening de 2 random Event(BetC)de event_type issue de la table ending de l' EventA

        $biomeStart = "Départ Biome 1";
        $eventA = $eventRepository->findEventA($biomeStart);
        // dump($eventA);

        $endingsCollection = $eventA->getEndings();

        $endingsEventA = $endingsCollection->toArray();
        // dump($endingsEventA);

        // Random des clés de $endingsEventA pour en garder 2
        $endingsPicked = array_rand($endingsEventA, 2);
        // dump($endingsPicked);

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($endingsPicked as $key => $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending
            // dump($oneEnding);
            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type
            // dump($collectionEventType);

            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id
            // dump($eventTypeId);

            $events = $eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId
            // dump($events);

            $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement
            // dump($eventPicked);

            $eventBAndC[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $eventBAndC
        }
        // dd($eventBAndC);
        $ending1 = $endingForFront[0];
        $ending2 = $endingForFront[1];
        $event1 = $eventBAndC[0];
        $event2 = $eventBAndC[1];

        $choices = [
            0 => [
                'ending' => $ending1->getContent(),
                'nextEventId' => $event1->getId(),
                'nextEventOpening' => $event1->getOpening()
            ],
            1 => [
                'ending' => $ending2->getContent(),
                'nextEventId' => $event2->getId(),
                'nextEventOpening' => $event2->getOpening()
            ],
        ];

        // ! data choice array unique (foreach coté front)

        $data = [
            'currentEvent' => $eventA,
            'choices' => $choices
        ];
        return $this->json200($data, ["game_start"]);

        // ======================================

        // $choices = [];
        // $index = 0;
        // foreach ($endingForFront as  $OneEnding) {
        //     $choices[$index++] = $OneEnding->getContent();
        // }
        // foreach ($eventBAndC as $OneEvent) {
        //     $choices[$index++] = $OneEvent->getId();
        //     $choices[$index++] = $OneEvent->getOpening();
        // }

        // $eventB[] = $choices[0];
        // $eventB[] = $choices[2];
        // $eventB[] = $choices[3];

        // $eventC[] = $choices[1];
        // $eventC[] = $choices[4];
        // $eventC[] = $choices[5];

        // ! data choice array multiple (sans foreach coté front)

        // $data = [
        //     'eventA' => $eventA,
        //     'choiceB' => $eventB,
        //     'choiceC' => $eventC,
        // ];
        // return $this->json200($data, ["game_start"]);


        // ! data initial event complet
        // $data = [
        //     'eventA' => $eventA,
        //     'endingsAforB1andC2' => $endingForFront,
        //     'eventB1andC2' => $eventBAndC
        // ];
        // return $this->json200($data, ["game_start"]);
    }

    /**
     * @Route("/api/event/roll/{id}", name="app_api_event_roll", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventRoll(
        $id,
        EventRepository $eventRepository
    ): JsonResponse {

        $eventA = $eventRepository->find($id);
        // dump($eventA);



        // ! Début service (param $eventA)
        $endingsCollection = $eventA->getEndings();

        $endingsEventA = $endingsCollection->toArray();
        // dump($endingsEventA);

        // Random des clés de $endingsEventA pour en garder 2
        $endingsPicked = array_rand($endingsEventA, 2);
        // dump($endingsPicked);

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($endingsPicked as $key => $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending
            // dump($oneEnding);
            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type
            // dump($collectionEventType);

            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id
            // dump($eventTypeId);

            $events = $eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId
            // dump($events);

            $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement
            // dump($eventPicked);

            $eventBAndC[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $eventBAndC
        }
        // dd($eventBAndC);
        // ! Sortie de boucle, préparation des Data souhaitées pour envoyer en Json
        $ending1 = $endingForFront[0];
        $ending2 = $endingForFront[1];
        $event1 = $eventBAndC[0];
        $event2 = $eventBAndC[1];

        $choices = [
            0 => [
                'ending' => $ending1->getContent(),
                'nextEventId' => $event1->getId(),
                'nextEventOpening' => $event1->getOpening()
            ],
            1 => [
                'ending' => $ending2->getContent(),
                'nextEventId' => $event2->getId(),
                'nextEventOpening' => $event2->getOpening()
            ],
        ];

        $data = [
            'currentEvent' => $eventA,
            'choices' => $choices
        ];

        // ! Fin service (return $data)

        return $this->json200($data, ["game_event_roll"]);
    }
}
