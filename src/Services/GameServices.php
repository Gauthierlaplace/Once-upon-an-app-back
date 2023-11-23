<?php

namespace App\Services;

use App\Repository\EffectRepository;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Repository\HeroClassRepository;
use App\Repository\HeroRepository;
use App\Repository\ItemRepository;
use App\Services\PlayedEventService;

class GameServices
{
    /**
     *
     * @var EventTypeRepository
     */
    private $eventTypeRepository;

    /**
     *
     * @var EndingRepository
     */
    private $endingRepository;

    /**
     *
     * @var EventRepository
     */
    private $eventRepository;

    /**
     *
     * @var HeroRepository
     */
    private $heroRepository;

    /**
     *
     * @var EffectRepository
     */
    private $effectRepository;

    /**
     *
     * @var PlayedEventService
     */
    private $playedEventService;

    /**
     *
     * @var HeroClassRepository
     */
    private $heroClassRepository;

    /**
     *
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(PlayedEventService $playedEventService, EventTypeRepository $eventTypeRepository, EndingRepository $endingRepository, EventRepository $eventRepository, HeroRepository $heroRepository, EffectRepository $effectRepository, HeroClassRepository $heroClassRepository, ItemRepository $itemRepository)
    {
        $this->eventTypeRepository = $eventTypeRepository;
        $this->endingRepository = $endingRepository;
        $this->eventRepository = $eventRepository;
        $this->heroRepository = $heroRepository;
        $this->effectRepository = $effectRepository;
        $this->playedEventService = $playedEventService;
        $this->heroClassRepository = $heroClassRepository;
    }


    /**
     *  Get Npc data with Race, Dialogue, answers, effects on the current Event
     * 
     * @param object $currentEnvent current event found by id
     * 
     * @return array $arrayNpc
     */
    public function getAllNpcData($currentEnvent)
    {

        $npcCollection = $currentEnvent->getNpc();
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
            if ($npc->getPicture()) {
                $npcPicture = $npc->getPicture()->getPath();
            } else {
                $npcPicture = [];
            }

            $arrayNpc = [
                "npcId" => $npc->getId(),
                "raceName" => $raceName,
                "raceDescription" => $raceDescription,
                "npcName" => $npc->getName(),
                "npcDescription" => $npc->getDescription(),
                "picture" => $npcPicture,
                "health" => $npc->getHealth(),
                "strength" => $npc->getStrength(),
                "intelligence" => $npc->getIntelligence(),
                "dexterity" => $npc->getDexterity(),
                "defense" => $npc->getDefense(),
                "karma" => $npc->getKarma(),
                "xpearned" => $npc->getXpEarned(),
                "hostility" => $npc->isHostility(),
                "dialogues" => $npcDialogue,

            ];
        }

        return $arrayNpc;
    }

    /**
     *  Get key for endings without ending event type Boss
     * 
     * @param array $endingsCurrentEvent current endings event 
     * 
     * @return array $randomizedEndingsPicked
     */
    public function getTwoRandomEndingsKeysWithoutBossType($endingsCurrentEvent)
    {

        // ! Exclure les EventType Boss de la pool de pick random eventType
        // on explore tout les endings du currentEnvent
        foreach ($endingsCurrentEvent as $ending) {
            // on garde l'id de l'ending en cours
            $endingId = $ending->getId();
            // on récupère l'EventType pour chaque
            $currentEnventtype = $ending->getEventType();
            // on stock l'id de cet eventType
            $currentEnventTypeId = $currentEnventtype->getId();
            // on recherche l'objet eventType avec l'id
            $checkNotBossType = $this->eventTypeRepository->findOneBy(['id' => $currentEnventTypeId]);

            $checkIdName = [($endingId) => ($checkNotBossType->getName())];

            foreach ($checkIdName as $getOutFromList => $EndingNameToBan) {
                if ($EndingNameToBan === "Boss") {
                    $EndingToDelete = $getOutFromList; //* ID de l'élément ending à supprimer dans $endingsCurrentEvent
                    // on va filtrer $endingsCurrentEvent pour retirer tout les endings de type Boss
                    $filteredEndingsEventA = array_filter($endingsCurrentEvent, function ($ending) use ($EndingToDelete) {
                        return $ending->getId() !== $EndingToDelete;
                    });
                }
            }
        };

        // Random des clés de $cleanedEndingsEventA pour en garder 2
        $endingsPicked = array_rand($filteredEndingsEventA, 2);

        // On obtient les clés du tableau d'origine
        $endingsPickedKeys = array_keys($endingsPicked);

        // Random de l'ordre des clés
        shuffle($endingsPickedKeys);

        // Création d'un nouveau tableau
        $randomizedEndingsPicked = array();

        // Parcours des clés randomisées
        foreach ($endingsPickedKeys as $endingsPickedKey) {
            // On assigne les valeurs correspondantes au nouveau tableau
            $randomizedEndingsPicked[$endingsPickedKey] = $endingsPicked[$endingsPickedKey];
        }

        return $randomizedEndingsPicked;
    }

    /**
     *  Get Dynamic Ending content of the current event
     * 
     * @param array $endings Endings from current event
     * @param mixed $currentEventId Id of the current Event
     * 
     * @return string $contentEndingCurrent Return the Current Ending content
     */
    public function getDynamicEnding($endings, $currentEventId)
    {
        foreach ($endings as $ending) {
            $endingCurrent = $ending->getEvent();
            $idEndingCurrent = $endingCurrent->getId();

            if ($idEndingCurrent == $currentEventId) {
                $contentEndingCurrent = $ending->getContent();
            }
        }

        return $contentEndingCurrent;
    }

    /**
     *  Get 2 Event Boss and shuffle the keys
     * 
     * @param mixed $eventTypeBossId Id of the EventType Boss
     * 
     * @return array $arrayBossData Return array of the 2 Event Boss picked
     */
    public function getShuffleEventBoss($eventTypeBossId)
    {
        $eventsBoss = $this->eventRepository->findBy(['eventType' => $eventTypeBossId]);

        $eventBossPicked = array_rand($eventsBoss, 2);

        $eventBossPickedKeys = array_keys($eventBossPicked);
        shuffle($eventBossPickedKeys);

        $randomizedEndingsPicked = [];
        foreach ($eventBossPickedKeys as $endingsPickedKey) {
            $randomizedEndingsPicked[$endingsPickedKey] = $eventBossPicked[$endingsPickedKey];
        }

        $arrayBossData = [];
        foreach ($randomizedEndingsPicked as $eventsBossKey) {

            $pickedBossEvent = $eventsBoss[$eventsBossKey];

            $arrayBossData[] = $pickedBossEvent;
        }
        return $arrayBossData;
    }

    /**
     *  Get Id and Opening for the next events
     * 
     * @param array $eventsSelectedForNextEvents  
     * 
     * @return array $eventsForNextEvents
     */
    public function getDataForNextEventsArray($eventsSelectedForNextEvents)
    {
        $eventsForNextEvents = [];
        foreach ($eventsSelectedForNextEvents as $event) {
            $id = $event->getId();
            $opening = $event->getOpening();
            $eventsForNextEvents[] = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }

        return $eventsForNextEvents;
    }

    /**
     *  Get Id and Opening for the next only event
     * 
     * @param array $eventsSelectedForNextEvents  
     * 
     * @return array $eventsForNextEvents
     */
    public function getDataForNextEventArray($eventsSelectedForNextEvents)
    {

        $eventsForNextEvents = [];
        foreach ($eventsSelectedForNextEvents as $event) {
            $id = $event->getId();
            $opening = $event->getOpening();
            $eventsForNextEvents = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }

        return $eventsForNextEvents;
    }

    /**
     *  Get 2 Random Endings(from current Event) with 2 Random Events
     * 
     * @param array $randomizedEndingsPicked 
     * @param array $endingsCurrentEvent 
     * 
     * @return array $choices Return array of the 2 Events to choose
     */
    public function getTwoEndingsWithTwoRandomEvent($randomizedEndingsPicked, $endingsCurrentEvent, $user, $idToAvoid = null)
    {
        $nextEvents = [];
        $endings = [];
        if ($idToAvoid === null) {
            foreach ($randomizedEndingsPicked as $endingsCurrentEventKey) { // * on boucle sur les 2 endings récupéré aléatoirement

                $oneEnding = $endingsCurrentEvent[$endingsCurrentEventKey]; // * on récupère chaque ending

                $endings[] = $oneEnding; // * on stock les deux endings dans un array $endings

                $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type

                $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id

                $events = $this->eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

                $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement

                $nextEvents[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $nextEvents
            }
        } else {
            // $idToAvoid correspond à l'Id de l'event à ne pas mettre dans $choices

            foreach ($randomizedEndingsPicked as $endingsCurrentEventKey) { // * on boucle sur les 2 endings récupéré aléatoirement

                $oneEnding = $endingsCurrentEvent[$endingsCurrentEventKey]; // * on récupère chaque ending

                $endings[] = $oneEnding; // * on stock les deux endings dans un array $endings

                $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type

                $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id

                $events = $this->eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

                // Taking out events already played during the game
                $playedEventArray = $this->playedEventService->getPlayedEventArray($user);
                if ($playedEventArray !== null) {
                    foreach ($playedEventArray as $eventId) {
                        foreach ($events as $key => $event) {
                            if ($event->getId() == $eventId) {
                                // on retire $event du tableau $events
                                unset($events[$key]);
                            }
                        }
                    }
                }
                // Taking out event with $idToAvoid
                $eventToDeleteOnEvents = $this->eventRepository->find($idToAvoid);
                foreach ($events as $key => $event) {

                    if ($event->getId() == $eventToDeleteOnEvents->getId()) {
                        // on retire $event du tableau $events
                        unset($events[$key]);
                        break;
                    }
                }

                $eventPicked = array_rand($events, 1); // * on récupère la clé de l'event choisi aléatoirement

                $nextEvents[] = $events[$eventPicked]; // * on stock l'event qui la clé $eventPicked dans un array $nextEvents
            }
        }

        $ending1 = $endings[0];
        $ending2 = $endings[1];
        $event1 = $nextEvents[0];
        $event2 = $nextEvents[1];

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
        return $choices;
    }

    /**
     *  Update Hero after Effect applied
     * 
     * @param mixed $id The id of the effect
     * @param mixed $user The Current User
     * 
     * @return array $hero Returns updated $hero
     */
    public function updateHeroAfterEffect($id, $user)
    {
        $hero = $this->heroRepository->findOneBy(["user" => $user->getId()]);

        $effect = $this->effectRepository->findOneBy(['id' => $id]);

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
        $this->heroRepository->add($hero, true);

        return $hero;
    }

    /**
     *  Test to know if the Hero survived
     * 
     * @param object $hero 
     * 
     * @return array $data with $hero and $eventDeath if the Hero dies, if he is still alive it returns $hero
     */
    public function heroSurvivedOrNot($hero, $user)
    {
        if ($hero->getHealth() <= 0) {

            $hero = $hero->setHealth(0);

            // * Hero Dies, Death Event needed
            $eventTypeDeath = $this->eventTypeRepository->findOneBy(['name' => "Death"]);
            $eventTypeDeathId = $eventTypeDeath->getId();
            $eventDeath = $this->eventRepository->findOneBy(['eventType' => $eventTypeDeathId]);

            //* Reset des playedEvent du Hero
            $this->playedEventService->resetPlayedEventToHero($user);

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
        return $data;
    }

    /**
     *  Reset the Hero health to his maxHealth to restart the game
     * 
     * @param mixed $user 
     * 
     * @return array $hero Return $hero with health reset to the maxHealth
     */
    public function resetHeroStatsAndInventory($user)
    {
        $hero = $this->heroRepository->findOneBy(["user" => $user->getId()]);

        $heroClass = $this->heroClassRepository->find($hero->getHeroClass());

        $hero->setMaxHealth($heroClass->getMaxHealth());
        $hero->setHealth($heroClass->getHealth());
        $hero->setStrength($heroClass->getStrength());
        $hero->setIntelligence($heroClass->getIntelligence());
        $hero->setDexterity($heroClass->getDexterity());
        $hero->setDefense($heroClass->getDefense());

        $itemsCollection =  $hero->getItem();
        $itemsCollection->clear();

        $this->heroRepository->add($hero, true);
        return $hero;
    }

    public function getAllCurrentEventData($currentEvent)
    {

        if ($currentEvent->getPicture()) {
            $picturePath = $currentEvent->getPicture()->getPath();
        } else {
            $picturePath = '';
        }

        $allCurrentEventData = [
            "id" => $currentEvent->getId(),
            "title" => $currentEvent->getTitle(),
            "description" => $currentEvent->getDescription(),
            "opening" => $currentEvent->getOpening(),
            "picture" => $picturePath,

        ];
        return $allCurrentEventData;
    }
}
