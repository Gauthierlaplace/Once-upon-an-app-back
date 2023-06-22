<?php

namespace App\Controller\api;

use App\Repository\EffectRepository;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Repository\HeroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends CoreApiController
{
    /**
     * @Route("/api/play", name="app_api_game" , methods={"GET"})
     */
    public function btnPlay(
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository,
        HeroRepository $heroRepository
    ): JsonResponse {
        // Arrivée Event Départ du Biome 1 , 1er noeud de choix d'ending
        // un random EventA Départ + opening de 2 random Event(BetC)de event_type issue de la table ending de l' EventA

        // TODO Stat Joueur pour que le lancement permette l'affichage de la santé du joueur

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $hero = $heroRepository->findOneBy(["user" => $user->getId()]);
        $hero->setHealth($hero->getMaxHealth());
        $heroRepository->add($hero, true);

        $biomeStart = "L'Arche de Verdure"; //* With Real Data
        // $biomeStart = "Départ Biome 1";
        $eventA = $eventRepository->findOneBy(['title' => $biomeStart]);

        $npcCollection = $eventA->getNpc();
        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue->getContent();
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i],
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }

            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray();

        // ! Service à Prévoir ?
        // ! Exclure les EventType Boss de la pool de pick random eventType
        // on explore tout les endings de l'eventA
        foreach ($endingsEventA as $endingEventA) {
            // on garde l'id de l'ending en cours
            $endingEventAId = $endingEventA->getId();
            // on récupère l'EventType pour chaque
            $eventAtype = $endingEventA->getEventType();
            dump($eventAtype);
            // on stock l'id de cet eventType
            $eventATypeId = $eventAtype->getId();
            dump($eventATypeId);
            // on recherche l'objet eventType avec l'id
            $checkNotBossType = $eventTypeRepository->findOneBy(['id' => $eventATypeId]);
            dump($checkNotBossType);
            $checkIdName = [($endingEventAId) => ($checkNotBossType->getName())];

            foreach ($checkIdName as $getOutFromList => $EndingNameToBan) {
                if ($EndingNameToBan === "Boss") {
                    $EndingToDelete = $getOutFromList; //* ID de l'élément ending à supprimer dans $endingsEventA
                    dump($EndingToDelete);
                    // on va filtrer $endingsEventA pour retirer tout les endings de type Boss
                    $filteredEndingsEventA = array_filter($endingsEventA, function ($ending) use ($EndingToDelete) {
                        dump($ending->getId() !== $EndingToDelete);
                        return $ending->getId() !== $EndingToDelete;
                    });
                }
            }
        };

        // Random des clés de $cleanedEndingsEventA pour en garder 2
        $endingsPicked = array_rand($filteredEndingsEventA, 2);

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($endingsPicked as $key => $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending

            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type

            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id

            $events = $eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

            $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement

            $eventBAndC[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $eventBAndC
        }

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
            'player' => $hero,
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'choices' => $choices
        ];
        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/roll/{id}", name="app_api_event_roll", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventRoll(
        $id,
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository
    ): JsonResponse {

        $eventA = $eventRepository->find($id);

        $npcCollection = $eventA->getNpc();

        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue;
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i]->getContent(),
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }

            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray();
        // dd($endingsEventA); //* tout les endings de l'EventA

        // ! Service à Prévoir ?
        // ! Exclure les EventType Boss de la pool de pick random eventType
        // on explore tout les endings de l'eventA
        foreach ($endingsEventA as $endingEventA) {
            // on garde l'id de l'ending en cours
            $endingEventAId = $endingEventA->getId();
            // on récupère l'EventType pour chaque
            $eventAtype = $endingEventA->getEventType();
            dump($eventAtype);
            // on stock l'id de cet eventType
            $eventATypeId = $eventAtype->getId();
            dump($eventATypeId);
            // on recherche l'objet eventType avec l'id
            $checkNotBossType = $eventTypeRepository->findOneBy(['id' => $eventATypeId]);
            dump($checkNotBossType);
            $checkIdName = [($endingEventAId) => ($checkNotBossType->getName())];

            foreach ($checkIdName as $getOutFromList => $EndingNameToBan) {
                if ($EndingNameToBan === "Boss") {
                    $EndingToDelete = $getOutFromList; //* ID de l'élément ending à supprimer dans $endingsEventA
                    dump($EndingToDelete);
                    // on va filtrer $endingsEventA pour retirer tout les endings de type Boss
                    $filteredEndingsEventA = array_filter($endingsEventA, function ($ending) use ($EndingToDelete) {
                        dump($ending->getId() !== $EndingToDelete);
                        return $ending->getId() !== $EndingToDelete;
                    });
                }
            }
        };

        dump($filteredEndingsEventA);
        // Random des clés de $cleanedEndingsEventA pour en garder 2
        $endingsPicked = array_rand($filteredEndingsEventA, 2);

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($endingsPicked as $key => $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending

            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type


            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id


            $events = $eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

            $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement

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
            'npcCurrentEvent' => $arrayNpc,
            'choices' => $choices
        ];

        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/last/{id}", name="app_api_last_event", requirements={"id"="\d+"}, methods={"GET"})
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
        dump($eventA);
        // * On garde l'event classic en ouverture, mais il aura en choices 2 event random de event_type "Boss"

        $npcCollection = $eventA->getNpc();
        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue->getContent();
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i],
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }

            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        // Récupération ending Boss de l'eventA
        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray(); // * Tout les endings de l'eventA

        $eventTypeBoss = $eventTypeRepository->findOneBy(['name' => "Boss"]); // * eventType Boss complet

        $eventTypeBossId = $eventTypeBoss->getId(); // * on stock l'id

        dump($eventTypeBossId);

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeBossId
        $endingsBoss = $endingRepository->findBy(["eventType" => $eventTypeBossId]); // * Tout les Endings Boss

        foreach ($endingsBoss as $ending) {
            $endingCurrent = $ending->getEvent();
            dump($endingCurrent); // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId();
            dump($idEndingCurrent); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Boss
            {
                $contentEndingCurrent = $ending->getContent();
                dump($contentEndingCurrent);
            }
        }


        $eventsBoss = $eventRepository->findBy(['eventType' => $eventTypeBossId]);
        dump($eventsBoss);
        // on a ici les 3 eventBoss
        //on en veut 2
        $eventBossPicked = array_rand($eventsBoss, 2);
        dump($eventBossPicked);

        $arrayBossData = [];
        foreach ($eventBossPicked as $eventsBossKey) {

            $pickedBossEvent = $eventsBoss[$eventsBossKey];

            $arrayBossData[] = $pickedBossEvent;
        }
        dump($arrayBossData);

        $dataForFront = [];
        foreach ($arrayBossData as $event) {
            $id = $event->getId();
            dump($id);
            $opening = $event->getOpening();
            dump($opening);
            $dataForFront[] = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }
        dump($dataForFront);

        // ! Préparation des Data souhaitées pour envoyer en Json

        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'BossA' => $dataForFront[0],
            'BossB' => $dataForFront[1]
        ];
        dump($data);

        return $this->json200($data, ["game"]);
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
        dump($eventA);
        // * On garde l'event classic en ouverture, mais il aura en choices 1 event de event_type "Fin de Biome"

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Fin de Biome"]);
        dump($eventTypeEndBiome); // * eventType Fin de Biome complet

        $npcCollection = $eventA->getNpc();
        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue->getContent();
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i],
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }

            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        // Récupération ending Fin de Biome de l'eventA
        $endingsCollection = $eventA->getEndings();
        dump($endingsCollection);
        $endingsEventA = $endingsCollection->toArray();
        dump($endingsEventA); // * Tout les endings de l'eventA

        $eventTypeEndBiomeId = $eventTypeEndBiome->getId(); // * on stock l'id
        dump($eventTypeEndBiomeId);


        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeEndBiomeId
        $endingsEndBiome = $endingRepository->findBy(["eventType" => $eventTypeEndBiomeId]);
        dump($endingsEndBiome); // * Tout les Endings Fin de Biome

        foreach ($endingsEndBiome as $ending) {
            $endingCurrent = $ending->getEvent();
            dump($endingCurrent); // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId();
            dump($idEndingCurrent); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Fin de Biome
            {
                $contentEndingCurrent = $ending->getContent();
                dump($contentEndingCurrent);
            }
        }

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);
        dump($eventsEndBiome);
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

        $dataForFront = [];
        foreach ($eventsEndBiome as $event) {
            $id = $event->getId();
            dump($id);
            $opening = $event->getOpening();
            dump($opening);
            $dataForFront = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }


        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEvent-Ending' => $contentEndingCurrent,
            'EndBiome' => $dataForFront
        ];


        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/end/{id}", name="app_api_event_end", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventEndBiome(
        $id,
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository,
        EndingRepository $endingRepository
    ): JsonResponse {

        $eventA = $eventRepository->find($id);
        dump($eventA);
        // * On garde l'event classic en ouverture, mais il aura en choices 1 event de event_type "ENDGAME"

        $npcCollection = $eventA->getNpc();

        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue->getContent();
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i],
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }




            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        // Récupération ending Fin de Biome de l'eventA
        $endingsCollection = $eventA->getEndings();

        $endingsEventA = $endingsCollection->toArray();
        // * Tout les endings de l'eventA

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeEndGameId
        foreach ($endingsEventA as $ending) {
            $endingCurrent = $ending->getEvent();
            dump($endingCurrent); // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId();
            dump($idEndingCurrent); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : EndGame
            {
                $contentEndingCurrent = $ending->getContent();
                dump($contentEndingCurrent);
            }
        }

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Endgame"]);
        dump($eventTypeEndBiome); // * eventType EndBiome complet
        $eventTypeEndBiomeId = $eventTypeEndBiome->getId();
        dump($eventTypeEndBiomeId);

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);
        dump($eventsEndBiome);

        $dataForFront = [];
        foreach ($eventsEndBiome as $event) {
            $id = $event->getId();
            dump($id);
            $opening = $event->getOpening();
            dump($opening);
            $dataForFront = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }

        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEvent-Ending' => $contentEndingCurrent,
            'EndGame' => $dataForFront
        ];


        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/victory/{id}", name="app_api_event_victory", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventEndGame(
        $id,
        EventRepository $eventRepository
    ): JsonResponse {

        $eventA = $eventRepository->find($id);

        $npcCollection = $eventA->getNpc();

        $npcs = $npcCollection->toArray();

        $arrayNpc = [];
        foreach ($npcs as $npc) {

            $raceName = $npc->getRace()->getName();
            $raceDescription = $npc->getRace()->getDescription();

            $dialoguesCollection = $npc->getDialogues();
            $dialogues =  $dialoguesCollection->toArray();

            $arrayDialogues = [];

            foreach ($dialogues as $key => $dialogue) {
                $arrayDialogues["dialogue" . ($key + 1)] = $dialogue->getContent();
                $answersCollection = $dialogue->getAnswers();
                $answers = $answersCollection->toArray();
                $arrayDialogues["answer" . ($key + 1)] = $answers;
            }

            $countDialogue = count($dialogues);
            for ($i = 1; $i <= $countDialogue; $i++) {
                $npcDialogue['dialogue' . $i] = [
                    'dialogue' => $arrayDialogues['dialogue' . $i],
                    'answer1' => $arrayDialogues['answer' . $i][0]->getContent(),
                    'effect1'   => $arrayDialogues['answer' . $i][0]->getEffect()[0],
                    'answer2'  => $arrayDialogues['answer' . $i][1]->getContent(),
                    'effect2' => $arrayDialogues['answer' . $i][1]->getEffect()[0],
                ];
            }


            $arrayNpc = [
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npc->getPicture(),
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "dialogues" => $npcDialogue,

            ];
        }

        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
        ];

        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/effect/{id}", name="app_api_event_effect", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventEffect(
        $id,
        EffectRepository $effectRepository,
        HeroRepository $heroRepository
    ): JsonResponse {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $hero = $heroRepository->findOneBy(["user" => $user->getId()]);

        $effect = $effectRepository->findOneBy(['id' => $id]);

        if ($effect->getHealth()) {
            $hero->setHealth($hero->getHealth() + $effect->getHealth());

            if ($hero->getHealth() >= $hero->getMaxHealth()) {
                $hero->setHealth($hero->getMaxHealth());
            }
        }
        if ($effect->getStrength()) {
            $hero->setStrength($hero->getStrength() + $effect->getStrength());
        }
        if ($effect->getIntelligence()) {
            $hero->setIntelligence($hero->getIntelligence() + $effect->getIntelligence());
        }
        if ($effect->getDexterity()) {
            $hero->setDexterity($hero->getDexterity() + $effect->getDexterity());
        }
        if ($effect->getDefense()) {
            $hero->setDefense($hero->getDefense() + $effect->getDefense());
        }
        if ($effect->getKarma()) {
            $hero->setKarma($hero->getKarma() + $effect->getKarma());
        }
        if ($effect->getXp()) {
            $hero->setXp($hero->getXp() + $effect->getXp());
        }

        $heroRepository->add($hero, true);

        if ($hero->getHealth() <= 0) {
            $hero = 'Vous êtes mort !';
            $data = [
                'player' => $hero,
                // 'GameOver' => $eventGameOVer
            ];
        } else {
            $data = [
                'player' => $hero,
            ];
        }



        return $this->json200($data, ["game"]);

        dd($hero);
    }
}
