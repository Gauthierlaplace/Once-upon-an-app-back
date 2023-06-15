<?php

namespace App\Controller\api;

use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends CoreApiController
{
    /**
     * @Route("/api/play", name="app_api_game" , methods={"GET"})
     */
    public function btnPlay(
        EventRepository $eventRepository,
        EndingRepository $endingRepository
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
        // dump($endingForFront);
        // dd($eventBAndC);

        $data = [
            'eventA' => $eventA,
            'endingsAforB1andC2' => $endingForFront,
            'eventB1andC2' => $eventBAndC
        ];


        return $this->json200($data, ["game_start"]);
    }
}
