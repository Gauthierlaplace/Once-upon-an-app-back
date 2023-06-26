<?php

namespace App\Controller\api;

use App\Repository\EffectRepository;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Repository\HeroRepository;
use App\Services\GameServices;
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
        HeroRepository $heroRepository,
        GameServices $gameServices
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

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray();

        $randomizedEndingsPicked = $gameServices->getTwoEndingsWithoutBossType($endingsEventA);
        
        $choices = $gameServices->getTwoEndingsWithTwoRandomEvent($randomizedEndingsPicked, $endingsEventA);

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
        EventTypeRepository $eventTypeRepository,
        GameServices $gameServices
    ): JsonResponse {

        $eventA = $eventRepository->find($id);

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray();
        //* tout les endings de l'EventA

        // ! Service à Prévoir ?
        $randomizedEndingsPicked = $gameServices->getTwoEndingsWithoutBossType($endingsEventA);


        // Affichez le nouveau tableau avec les clés randomisées

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($randomizedEndingsPicked as $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending

            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type


            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id


            $events = $eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

            $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement

            $eventBAndC[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $eventBAndC
        }
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
        EndingRepository $endingRepository,
        GameServices $gameServices
    ): JsonResponse {

        // TODO on veut que B et C soient un event de type Boss random
        // Il faut select l'event_type "Boss" et on prendre 2 event random Boss

        $eventA = $eventRepository->find($id);
        // * On garde l'event classic en ouverture, mais il aura en choices 2 event random de event_type "Boss"

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        $eventTypeBoss = $eventTypeRepository->findOneBy(['name' => "Boss"]); // * eventType Boss complet

        $eventTypeBossId = $eventTypeBoss->getId(); // * on stock l'id

        $contentEndingCurrent = $gameServices->getDynamicEnding($eventTypeBossId, $id);

        $dataForFront = $gameServices->getShuffleEventBoss($eventTypeBossId);
        

        // ! Préparation des Data souhaitées pour envoyer en Json

        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'BossA' => $dataForFront[0],
            'BossB' => $dataForFront[1]
        ];

        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/boss/{id}", name="app_api_event_boss", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventBoss(
        $id,
        EventRepository $eventRepository,
        EventTypeRepository $eventTypeRepository,
        EndingRepository $endingRepository,
        GameServices $gameServices
    ): JsonResponse {

        // TODO on veut que B et C soient un event de type Fin de Biome random (MVP Une seule fin de Biome)

        $eventA = $eventRepository->find($id);
        // * On garde l'event classic en ouverture, mais il aura en choices 1 event de event_type "Fin de Biome"

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Fin de Biome"]);

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        // Récupération ending Fin de Biome de l'eventA
        $endingsCollection = $eventA->getEndings();
        $endingsEventA = $endingsCollection->toArray();

        $eventTypeEndBiomeId = $eventTypeEndBiome->getId(); // * on stock l'id


        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeEndBiomeId
        $endingsEndBiome = $endingRepository->findBy(["eventType" => $eventTypeEndBiomeId]);

        foreach ($endingsEndBiome as $ending) {
            $endingCurrent = $ending->getEvent();
            $idEndingCurrent = $endingCurrent->getId();
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Fin de Biome
            {
                $contentEndingCurrent = $ending->getContent();
            }
        }

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);
        // on a ici l'eventEndBiome

        //* This foreach explores $eventEndBiomePicked in case there is more than 1 key (v2 use)
        //on en veut 2
        // $eventEndBiomePicked = array_rand($eventsEndBiome, 2);
        // $arrayEndBiomeData = [];
        // foreach ($eventEndBiomePicked as $key => $eventsEndBiomeKey) {
        //     $pickedEndBiomeEvent = $eventsEndBiome[$eventsEndBiomeKey];

        //     $arrayEndBiomeData[] = $pickedEndBiomeEvent;
        // }

        $dataForFront = [];
        foreach ($eventsEndBiome as $event) {
            $id = $event->getId();
            $opening = $event->getOpening();
            $dataForFront = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }


        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
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
        EndingRepository $endingRepository,
        GameServices $gameServices
    ): JsonResponse {

        $eventA = $eventRepository->find($id);
        // * On garde l'event classic en ouverture, mais il aura en choices 1 event de event_type "ENDGAME"

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        // Récupération ending Fin de Biome de l'eventA
        $endingsCollection = $eventA->getEndings();

        $endingsEventA = $endingsCollection->toArray();
        // * Tout les endings de l'eventA

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeEndGameId
        foreach ($endingsEventA as $ending) {
            $endingCurrent = $ending->getEvent();
            $idEndingCurrent = $endingCurrent->getId();
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : EndGame
            {
                $contentEndingCurrent = $ending->getContent();
            }
        }

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Endgame"]);
        $eventTypeEndBiomeId = $eventTypeEndBiome->getId();

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);

        $dataForFront = [];
        foreach ($eventsEndBiome as $event) {
            $id = $event->getId();
            $opening = $event->getOpening();
            $dataForFront = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }

        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'EndGame' => $dataForFront
        ];


        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/victory/{id}", name="app_api_event_victory", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventEndGame(
        $id,
        EventRepository $eventRepository,
        GameServices $gameServices
    ): JsonResponse {

        $eventA = $eventRepository->find($id);

        $arrayNpc = $gameServices->getAllNpcData($eventA);

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
        HeroRepository $heroRepository,
        EventTypeRepository $eventTypeRepository,
        EventRepository $eventRepository
    ): JsonResponse {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $hero = $heroRepository->findOneBy(["user" => $user->getId()]);

        $effect = $effectRepository->findOneBy(['id' => $id]);

        // * Applying Effect to Player ($hero)
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

        // Saving Hero in Database
        $heroRepository->add($hero, true);

        // * Hero Dies, Death Event needed
        $eventTypeDeath = $eventTypeRepository->findOneBy(['name' => "Death"]);
        $eventTypeDeathId = $eventTypeDeath->getId();
        $eventDeath = $eventRepository->findOneBy(['eventType' => $eventTypeDeathId]);

        // * Hero survived the effect or not ?
        if ($hero->getHealth() <= 0) {
            // * Hero didn't survive the effect, $hero object become a string, $data return $hero + the Death event opening + id
            $hero = 'Vous êtes mort !';
            $data = [
                'player' => $hero,
                'GameOver' => $eventDeath
            ];
        } else {
            // * Hero survived the effect, the game goes on
            $data = [
                'player' => $hero,
            ];
        }

        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/death/{id}", name="app_api_event_death", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function death(
        $id,
        EventRepository $eventRepository,
        GameServices $gameServices
    ) {

        $eventA = $eventRepository->find($id);

        $arrayNpc = $gameServices->getAllNpcData($eventA);

        // ! Préparation des Data souhaitées pour envoyer en Json
        $data = [
            'currentEvent' => $eventA,
            'npcCurrentEvent' => $arrayNpc,
        ];

        return $this->json200($data, ["game"]);
    }
}
