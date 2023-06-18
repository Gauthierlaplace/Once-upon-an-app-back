<?php

namespace App\Controller\api;

use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("/api/last/event/{id}", name="app_api_last_event", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function lastEventBeforeBoss(
        $id,
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository,
        EndingRepository $endingRepository
    ): JsonResponse {

        // TODO on veut que B et C soient un event de type Boss random
        // Il faut select l'event_type "Boss" et on prendre 2 event random Boss

        $eventA = $eventRepository->find($id);
        // dump($eventA);
        // * On garde l'event classic en ouverture, mais il aura en choices 2 event random de event_type "Boss"

        $eventTypeBoss = $eventTypeRepository->findBy(['name' => "Boss"]);
        // dd($eventTypeBoss); // * eventType Boss complet
        foreach ($eventTypeBoss as $eventType) {
            $eventTypeBossId = $eventType->getId(); // * on stock l'id
        }
        // dump($eventTypeBossId);

        // Récupération ending Boss de l'eventA
        $endingsCollection = $eventA->getEndings();
        // dd($endingsCollection);
        $endingsEventA = $endingsCollection->toArray();
        // dump($endingsEventA); // * Tout les endings de l'eventA

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeBossId
        $endingsBoss = $endingRepository->findEndingBoss($eventTypeBossId);
        // dd($endingsBoss); // * Tout les Endings Boss

        foreach ($endingsBoss as $ending) {
            $endingCurrent = $ending->getEvent();
            //    dump($endingCurrent); // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId();
            //    dump($idEndingCurrent); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Boss
            {
                $contentEndingCurrent = $ending->getContent();
                // dump($contentEndingCurrent);
            }
        }


        $eventsBoss = $eventRepository->findBy(['eventType' => $eventTypeBossId]);
        // dump($eventsBoss);
        // on a ici les 3 eventBoss
        //on en veut 2
        $eventBossPicked = array_rand($eventsBoss, 2);
        // dd($eventBossPicked);

        $arrayBossData = [];
        foreach ($eventBossPicked as $key => $eventsBossKey) {
            $pickedBossEvent = $eventsBoss[$eventsBossKey];

            $arrayBossData[] = $pickedBossEvent;
        }
        // dump($arrayBossData);

        $dataForFront = [];
        foreach ($arrayBossData as $event) {
            $id = $event->getId();
            // dump($id);
            $opening = $event->getOpening();
            // dump($opening);
            $dataForFront[] = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }
        // dump($dataForFront);

        // ! Préparation des Data souhaitées pour envoyer en Json

        $data = [
            'currentEvent' => $eventA,
            'currentEvent-Ending' => $contentEndingCurrent,
            'BossA' => $dataForFront[0],
            'BossB' => $dataForFront[1]
        ];
        // dump($data);

        return $this->json200($data, ["game_last_event_before_boss"]);
    }

    /**
     * @Route("/api/event/boss/{id}", name="app_api_event_boss", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventBoss(
        $id,
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository,
        EndingRepository $endingRepository
    ): JsonResponse {

        // TODO on veut que B et C soient un event de type Fin de Biome random (MVP Une seule fin de Biome)

        $eventA = $eventRepository->find($id);
        // dump($eventA);
        // * On garde l'event classic en ouverture, mais il aura en choices 1 event de event_type "Fin de Biome"

        $eventTypeEndBiome = $eventTypeRepository->findBy(['name' => "Fin de Biome"]);
        // dump($eventTypeEndBiome); // * eventType Fin de Biome complet
        foreach ($eventTypeEndBiome as $eventType) {
            $eventTypeEndBiomeId = $eventType->getId(); // * on stock l'id
        }
        // dump($eventTypeEndBiomeId);

        // Récupération ending Fin de Biome de l'eventA
        $endingsCollection = $eventA->getEndings();
        // dump($endingsCollection);
        $endingsEventA = $endingsCollection->toArray();
        // dump($endingsEventA); // * Tout les endings de l'eventA

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeEndBiomeId
        $endingsEndBiome = $endingRepository->findEndingBiome($eventTypeEndBiomeId);
        // dump($endingsEndBiome); // * Tout les Endings Fin de Biome

        foreach ($endingsEndBiome as $ending) {
            $endingCurrent = $ending->getEvent();
            //    dump($endingCurrent); // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId();
            //    dump($idEndingCurrent); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Fin de Biome
            {
                $contentEndingCurrent = $ending->getContent();
                // dump($contentEndingCurrent);
            }
        }

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);
        // dump($eventsEndBiome);
        // on a ici l'eventEndBiome
        
        //* This foreach explores $eventEndBiomePicked in case there is more than 1 key (v2 use)
        //on en veut 2
        // $eventEndBiomePicked = array_rand($eventsEndBiome, 2);
        // dump($eventEndBiomePicked);
        // $arrayEndBiomeData = [];
        // foreach ($eventEndBiomePicked as $key => $eventsEndBiomeKey) {
        //     $pickedEndBiomeEvent = $eventsEndBiome[$eventsEndBiomeKey];

        //     $arrayEndBiomeData[] = $pickedEndBiomeEvent;
        // }
        // dd($arrayEndBiomeData);

        // $dataForFront = [];
        foreach ($eventsEndBiome as $event) {
            $id = $event->getId();
            // dump($id);
            $opening = $event->getOpening();
            // dump($opening);
            $dataForFront = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }
        // dd($dataForFront);

        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'currentEvent-Ending' => $contentEndingCurrent,
            'EndBiome' => $dataForFront
        ];
        // dd($data);

        return $this->json200($data, ["game_event_boss"]);
    }
}
