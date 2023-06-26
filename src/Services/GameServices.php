<?php

namespace App\Services;

use App\Entity\Ending;
use App\Entity\Event;
use App\Repository\EndingRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class GameServices
{
    /**
     * le requete en cours
     *
     * @var RequestStack
     */
    private $request;

    /**
     *
     * @var EventTypeRepository
     */
    private $eventTypeRepository;

    /**
     *
     * @var EventTypeRepository
     */
    private $endingRepository;

    /**
     *
     * @var EventTypeRepository
     */
    private $eventRepository;

    public function __construct(RequestStack $request, EventTypeRepository $eventTypeRepository, EndingRepository $endingRepository, EventRepository $eventRepository)
    {
        $this->request = $request;
        $this->eventTypeRepository = $eventTypeRepository;
        $this->endingRepository = $endingRepository;
        $this->eventRepository = $eventRepository;
    }



    public function getAllNpcData(Event $eventA)
    {

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

        return $arrayNpc;
    }

    public function getTwoEndingsWithoutBossType($endingsEventA)
    {

        // ! Exclure les EventType Boss de la pool de pick random eventType
        // on explore tout les endings de l'eventA
        foreach ($endingsEventA as $endingEventA) {
            // on garde l'id de l'ending en cours
            $endingEventAId = $endingEventA->getId();
            // on récupère l'EventType pour chaque
            $eventAtype = $endingEventA->getEventType();
            // on stock l'id de cet eventType
            $eventATypeId = $eventAtype->getId();
            // on recherche l'objet eventType avec l'id
            $checkNotBossType = $this->eventTypeRepository->findOneBy(['id' => $eventATypeId]);

            $checkIdName = [($endingEventAId) => ($checkNotBossType->getName())];

            foreach ($checkIdName as $getOutFromList => $EndingNameToBan) {
                if ($EndingNameToBan === "Boss") {
                    $EndingToDelete = $getOutFromList; //* ID de l'élément ending à supprimer dans $endingsEventA
                    // on va filtrer $endingsEventA pour retirer tout les endings de type Boss
                    $filteredEndingsEventA = array_filter($endingsEventA, function ($ending) use ($EndingToDelete) {
                        return $ending->getId() !== $EndingToDelete;
                    });
                }
            }
        };

        // Random des clés de $cleanedEndingsEventA pour en garder 2
        $endingsPicked = array_rand($filteredEndingsEventA, 2);

        // Obtenez les clés du tableau d'origine
        $endingsPickedKeys = array_keys($endingsPicked);

        // Randomisez l'ordre des clés
        shuffle($endingsPickedKeys);

        // Créez un nouveau tableau
        $randomizedEndingsPicked = array();

        // Parcourez les clés randomisées
        foreach ($endingsPickedKeys as $endingsPickedKey) {
            // Assignez les valeurs correspondantes au nouveau tableau
            $randomizedEndingsPicked[$endingsPickedKey] = $endingsPicked[$endingsPickedKey];
        }

        return $randomizedEndingsPicked;
    }

    public function getDynamicEnding($eventTypeBossId, $id)
    {

        // * isoler le ending
        // * trouver le ending where eventType = $eventTypeBossId
        $endingsBoss = $this->endingRepository->findBy(["eventType" => $eventTypeBossId]); // * Tout les Endings Boss

        foreach ($endingsBoss as $ending) {
            $endingCurrent = $ending->getEvent();  // * object Event complet avec uniquement l'id dispo
            $idEndingCurrent = $endingCurrent->getId(); // * on récupère uniquement l'id
            if ($idEndingCurrent == $id) // * Si l'$id(eventA) = l'idEndingCurrent alors on a le bon Event donc on peut récupérer le contenu du bon ending de event_type : Boss
            {
                $contentEndingCurrent = $ending->getContent();
            }
        }

        return $contentEndingCurrent;
    }

    public function getShuffleEventBoss($eventTypeBossId)
    {
        $eventsBoss = $this->eventRepository->findBy(['eventType' => $eventTypeBossId]);
        // on a ici les 3 eventBoss
        //on en veut 2
        $eventBossPicked = array_rand($eventsBoss, 2);

        // Obtenez les clés du tableau d'origine
        $eventBossPickedKeys = array_keys($eventBossPicked);
        // Randomisez l'ordre des clés
        shuffle($eventBossPickedKeys);

        // Créez un nouveau tableau
        $randomizedEndingsPicked = array();

        // Parcourez les clés randomisées
        foreach ($eventBossPickedKeys as $endingsPickedKey) {
            // Assignez les valeurs correspondantes au nouveau tableau
            $randomizedEndingsPicked[$endingsPickedKey] = $eventBossPicked[$endingsPickedKey];
        }

        // Affichez le nouveau tableau avec les clés randomisées

        $arrayBossData = [];
        foreach ($randomizedEndingsPicked as $eventsBossKey) {

            $pickedBossEvent = $eventsBoss[$eventsBossKey];

            $arrayBossData[] = $pickedBossEvent;
        }

        $dataForFront = [];
        foreach ($arrayBossData as $event) {
            $id = $event->getId();
            $opening = $event->getOpening();
            $dataForFront[] = [
                "Id" => $id,
                "Opening" => $opening
            ];
        }

        return $dataForFront;
    }

    public function getTwoEndingsWithTwoRandomEvent($randomizedEndingsPicked, $endingsEventA) {

        $eventBAndC = [];
        $endingForFront = [];
        foreach ($randomizedEndingsPicked as $endingsEventAKey) { // * on boucle sur les 2 endings récupéré aléatoirement

            $oneEnding = $endingsEventA[$endingsEventAKey]; // * on récupère chaque ending

            $endingForFront[] = $oneEnding; // * on stock les deux endings dans un array $endingForFront

            $collectionEventType = $oneEnding->getEventType(); // * pour chaque ending, on récupère son event_type

            $eventTypeId = $collectionEventType->getId(); // * pour chaque event_type, on récupère son id

            $events = $this->eventRepository->findBy(['eventType' => $eventTypeId]); // * récupération de tout les events correspondant à $eventTypeId

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

        return $choices;

    }
}
