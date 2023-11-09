<?php

namespace App\Controller\api;

use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Services\GameServices;
use App\Services\PlayedEventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends CoreApiController
{
    /**
     * @Route("/api/play", name="app_api_game" , methods={"GET"})
     */
    public function btnPlay(
        EventRepository $eventRepository,
        GameServices $gameServices,
        PlayedEventService $playedEventService
    ): JsonResponse {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $hero = $gameServices->resetHeroHealth($user);

        $biomeStart = "L'Arche de Verdure";
        $currentEvent = $eventRepository->findOneBy(['title' => $biomeStart]);
        $playedEventService->resetPlayedEventToHero($user);
        $idCurrentEvent = $currentEvent->getId();
        $playedEventService->checkEventIdIsUnique($idCurrentEvent, $user);

        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $endingsCollection = $currentEvent->getEndings();
        $endingscurrentEvent = $endingsCollection->toArray();

        $randomizedEndingsPicked = $gameServices->getTwoRandomEndingsKeysWithoutBossType($endingscurrentEvent);

        $choices = $gameServices->getTwoEndingsWithTwoRandomEvent($randomizedEndingsPicked, $endingscurrentEvent, $user);

        $data = [
            'player' => $hero,
            'currentEvent' => $allCurrentEventData,
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
        GameServices $gameServices,
        PlayedEventService $playedEventService
    ): JsonResponse {

        //!-------------------------------------------------------------------------------------------------
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        // if ($playedEventService->checkEventIdIsUnique($id, $user) == true) {
        //     // == true on

        // } else {
        //     // ==false

        // }
        //!-------------------------------------------------------------------------------------------------
        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $endingsCollection = $currentEvent->getEndings();
        $endingscurrentEvent = $endingsCollection->toArray();

        $randomizedEndingsPicked = $gameServices->getTwoRandomEndingsKeysWithoutBossType($endingscurrentEvent);

        $choices = $gameServices->getTwoEndingsWithTwoRandomEvent($randomizedEndingsPicked, $endingscurrentEvent, $user);

        $data = [
            'currentEvent' => $allCurrentEventData,
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

        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $eventTypeBoss = $eventTypeRepository->findOneBy(['name' => "Boss"]);

        $eventTypeBossId = $eventTypeBoss->getId();

        $endingsBoss = $endingRepository->findBy(["eventType" => $eventTypeBossId]);

        $contentEndingCurrent = $gameServices->getDynamicEnding($endingsBoss, $id);

        $arrayBossData = $gameServices->getShuffleEventBoss($eventTypeBossId);

        $dataForNextEvent = $gameServices->getDataForNextEventsArray($arrayBossData);

        $data = [
            'currentEvent' => $allCurrentEventData,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'BossA' => $dataForNextEvent[0],
            'BossB' => $dataForNextEvent[1]
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

        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Fin de Biome"]);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $eventTypeEndBiomeId = $eventTypeEndBiome->getId();

        $endingsEndBiome = $endingRepository->findBy(["eventType" => $eventTypeEndBiomeId]);

        $contentEndingCurrent = $gameServices->getDynamicEnding($endingsEndBiome, $id);

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);

        $dataForNextEvent = $gameServices->getDataForNextEventArray($eventsEndBiome);

        $data = [
            'currentEvent' => $allCurrentEventData,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'EndBiome' => $dataForNextEvent
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
        GameServices $gameServices
    ): JsonResponse {

        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $endingsCollection = $currentEvent->getEndings();
        $endingscurrentEvent = $endingsCollection->toArray();

        $contentEndingCurrent = $gameServices->getDynamicEnding($endingscurrentEvent, $id);

        $eventTypeEndBiome = $eventTypeRepository->findOneBy(['name' => "Endgame"]);
        $eventTypeEndBiomeId = $eventTypeEndBiome->getId();

        $eventsEndBiome = $eventRepository->findBy(['eventType' => $eventTypeEndBiomeId]);

        $dataForNextEvent = $gameServices->getDataForNextEventArray($eventsEndBiome);

        $data = [
            'currentEvent' => $allCurrentEventData,
            'npcCurrentEvent' => $arrayNpc,
            'currentEventEnding' => $contentEndingCurrent,
            'EndGame' => $dataForNextEvent
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

        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $data = [
            'currentEvent' => $allCurrentEventData,
            'npcCurrentEvent' => $arrayNpc,
        ];
        return $this->json200($data, ["game"]);
    }

    /**
     * @Route("/api/event/effect/{id}", name="app_api_event_effect", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function eventEffect(
        $id,
        GameServices $gameServices
    ): JsonResponse {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $hero = $gameServices->updateHeroAfterEffect($id, $user);

        $data = $gameServices->heroSurvivedOrNot($hero, $user);

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

        $currentEvent = $eventRepository->find($id);
        $allCurrentEventData = $gameServices->getAllCurrentEventData($currentEvent);

        $arrayNpc = $gameServices->getAllNpcData($currentEvent);

        $data = [
            'currentEvent' => $allCurrentEventData,
            'npcCurrentEvent' => $arrayNpc,
        ];

        return $this->json200($data, ["game"]);
    }
}
