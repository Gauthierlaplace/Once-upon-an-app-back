<?php

namespace App\Controller\api;

use App\Entity\Fight;
use App\Repository\EffectRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
use App\Repository\FightRepository;
use App\Repository\HeroRepository;
use App\Repository\NpcRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends CoreApiController
{
    /**
     * ! Combat Phase 1 : Application de l'effet d'introduction au combat, permettant de déterminer qui portera ensuite le premier coup
     *
     * @Route("/api/event/fight/{npcId}/attack/{effectId}", name="app_api_introAttack" , requirements={"effectId"="\d+", "npcId"="\d+"}, methods={"GET"})
     */
    public function introAttack($effectId, $npcId, FightRepository $fightRepository, NpcRepository $npcRepository, EffectRepository $effectRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
    {
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $heroesCollection = $user->getHeroes();
        $heroes = $heroesCollection->toArray();

        $arrayHero = [];
        foreach ($heroes as $hero) {
            $arrayHero = [
                'heroId' => $hero->getId(),
                'heroName' => $hero->getName(),
                'heroMaxHealth' => $hero->getMaxHealth(),
                'health' => $hero->getHealth(),
                'heroStrength' => $hero->getStrength(),
                'heroIntelligence' => $hero->getIntelligence(),
                'heroDexterity' => $hero->getDexterity(),
                'heroDefense' => $hero->getDefense(),
                'heroKarma' => $hero->getKarma(),
            ];
        }

        // ---------------------------------------------------------------------------
        //* On veut copier un npc dans la table Fight
        //* On récupère l'objet npc et on charge les éléments souhaités dans l'objet Fight
        $npc = $npcRepository->find($npcId);

        $npcItemsCollection = $npc->getItem();
        $npcItems = $npcItemsCollection->toArray();

        if ($npcItems) {
            foreach ($npcItems as $npcItem) {
                $item = $npcItem->getId();
            }
        } else {
            $item = null;
        }

        $fight = new Fight;
        $fight->setHero($hero);
        $fight->setName($npc->getName());
        $fight->setDescription($npc->getDescription());
        $fight->setMaxHealth($npc->getMaxHealth());
        $fight->setHealth($npc->getHealth());
        $fight->setStrength($npc->getStrength());
        $fight->setIntelligence($npc->getIntelligence());
        $fight->setDexterity($npc->getDexterity());
        $fight->setDefense($npc->getDefense());
        $fight->setKarma($npc->getKarma());
        $fight->setHostility($npc->isHostility());
        $fight->setIsBoss($npc->isIsBoss());
        $fight->setXpEarned($npc->getXpEarned());
        $fight->setItem($item);

        $fightRepository->add($fight, true);

        // ---------------------------------------------------------------------------

        $arrayNpc = [
            'npcId' => $fight->getId(),
            'npcName' => $fight->getName(),
            'npcMaxHealth' => $fight->getMaxHealth(),
            'npcHealth' => $fight->getHealth(),
            'npcStrength' => $fight->getStrength(),
            'npcIntelligence' => $fight->getIntelligence(),
            'npcDexterity' => $fight->getDexterity(),
            'npcDefense' => $fight->getDefense(),
            'npcKarma' => $fight->getKarma(),
        ];

        $effect = $effectRepository->find($effectId);

        $arrayEffect = [
            'effectId' => $effect->getId(),
            'effectName' => $effect->getName(),
            'effectDescription' => $effect->getDescription(),
            'effectHealth' => $effect->getHealth(),
            'effectStrength' => $effect->getStrength(),
            'effectIntelligence' => $effect->getIntelligence(),
            'effectDexterity' => $effect->getDexterity(),
            'effectDefense' => $effect->getDefense(),
            'effectKarma' => $effect->getKarma(),
            'effectXp' => $effect->getXp(),
        ];

        //* Déterminer qui commencera le combat en fonction de l'id de l'effet
        // si l'effet est positif on influe sur la vie du NPC, le Npc attaque en premier
        // si l'effet est négatif on influe sur la vie du Player, le Player attaque en premier

        $npcCurrentHealth = $arrayNpc['npcHealth'];

        if ($arrayEffect['effectHealth'] <= 0) {
            // on tape le Héro et on le MAJ en BDD
            $heroToApplyEffect = $heroRepository->findOneBy(["user" => $user->getId()]);
            //*on détermine la santé du hero
            $newHeroHealthToApply = $arrayHero['health'] + $arrayEffect['effectHealth'];
            //*On vérifie que le hero survit
            if ($newHeroHealthToApply <= 0) {
                //* Le hero est mort durant l'application de l'effet introduisant le combat
                $newHeroHealthToApply = 0;
                //* Maj vie du hero
                $heroEffectApplied = $heroToApplyEffect->setHealth($newHeroHealthToApply);
                //* Update en BDD
                $heroUpdated = $heroRepository->add($heroEffectApplied, true);

                // Supprimer le npc de la table Fight car le combat est terminé
                $fight->setHero(null);
                $fightDeleted = $fightRepository->remove($fight, true);

                //* Il nous faut l'event Death
                $eventTypeDeath = $eventTypeRepository->findOneBy(['name' => "Death"]);
                $eventTypeDeathId = $eventTypeDeath->getId();
                $eventDeath = $eventRepository->findOneBy(['eventType' => $eventTypeDeathId]);

                //* On renvoie le Json avec les infos
                $data = [
                    'player' => $hero,
                    'GameOver' => $eventDeath
                ];
                return $this->json200($data, ["game"]);
            } else {
                // Le hero a survécu à l'effet, on applique le modification de health
                //* Maj vie du hero
                $heroEffectApplied = $heroToApplyEffect->setHealth($newHeroHealthToApply);
                //* Update en BDD
                $heroUpdated = $heroRepository->add($heroEffectApplied, true);
            }

            $arrayHero['health'] = $newHeroHealthToApply;
            $attacker = "hero";
        } else {
            //* on tape le npc et on MAJ en BDD
            //*on détermine la santé du npc en appliquant l'effet
            $newNpcHealthToApply = $arrayNpc['npcHealth'] - $arrayEffect['effectHealth'];

            //*On vérifie que le npc survit
            if ($newNpcHealthToApply <= 0) {
                //* Le npc est mort durant l'application de l'effet introduisant le combat

                // Supprimer le npc de la table Fight car le combat est terminé
                $fight->setHero(null);
                $fightDeleted = $fightRepository->remove($fight, true);

                $arrayNpc['npcHealth'] = $newNpcHealthToApply;
                $attacker = "end of battle";
            } else {
                //* Le npc a survécu à l'effet, on applique le modification de health
                //* Maj vie du npc
                $npcEffectApplied = $fight->setHealth($newNpcHealthToApply);

                //* Update en BDD
                $arrayNpc['npcHealth'] = $newNpcHealthToApply;
                $npcUpdated = $fightRepository->add($fight, true);
                $attacker = "npc";
            }
        }

        $data = [
            'player' => $arrayHero,
            'npc' => $arrayNpc,
            'effect' => $arrayEffect,
            'attacker' => $attacker,
            'attackerFightId' => $arrayNpc['npcId'],
        ];

        return $this->json200($data, ["game"]);
    }

    /**
     * ! Combat Phase 2 : Test touché ou pas et application de Rolls de dés sur la vie du défenseur correspondant, vérification de l'état de santé du défenseur et retour JSON en fonction de la vie ou mort du défenseur, désignation de l'attacker suivant s'il survit
     *
     * @Route("/api/event/fight/{fightId}/attacker/{attackerName}", name="app_api_attack" , requirements={"fightId"="\d+", "attackerName"="\w+"}, methods={"GET"})
     */
    public function attack($fightId, $attackerName, FightRepository $fightRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
    {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $heroesCollection = $user->getHeroes();
        $heroes = $heroesCollection->toArray();

        $arrayHero = [];
        foreach ($heroes as $hero) {
            $arrayHero = [
                'heroId' => $hero->getId(),
                'heroName' => $hero->getName(),
                'heroMaxHealth' => $hero->getMaxHealth(),
                'health' => $hero->getHealth(),
                'heroStrength' => $hero->getStrength(),
                'heroIntelligence' => $hero->getIntelligence(),
                'heroDexterity' => $hero->getDexterity(),
                'heroDefense' => $hero->getDefense(),
                'heroKarma' => $hero->getKarma(),
            ];
        }


        //* On récupère l'objet Fight (le npc)
        $fight = $fightRepository->find($fightId);

        $arrayNpc = [
            'npcId' => $fight->getId(),
            'npcName' => $fight->getName(),
            'npcMaxHealth' => $fight->getMaxHealth(),
            'npcHealth' => $fight->getHealth(),
            'npcStrength' => $fight->getStrength(),
            'npcIntelligence' => $fight->getIntelligence(),
            'npcDexterity' => $fight->getDexterity(),
            'npcDefense' => $fight->getDefense(),
            'npcKarma' => $fight->getKarma(),
        ];
        

        $arrayRolls = [];

        // ----------------------------------------HERO START ATTACKER---------------------------------------------------
        if ($attackerName === "hero") {
            //* le hero frappe le npc

            // 1. Miss Or Not
            // On a besoin de récupérer la stat la plus haute entre strenght, intelligence et dexterity du hero
            $higherStatAttacker = max($arrayHero["heroStrength"], $arrayHero["heroIntelligence"], $arrayHero["heroDexterity"]);
            // On a besoin de la stat defense du npc
            $defenseNpc = $fight->getDefense() + 3;

            // On lance un dé de (1-10) que l'on ajoute à la stat la plus haute du hero
            $diceAccurancy = rand(1, 10) + $higherStatAttacker;

            // Si le résultat est supérieur à la défense du npc
            if ($diceAccurancy >= $defenseNpc) {
                $hit = true;
                $damageDice1 = rand(1, 4);
                $damageDice2 = rand(1, 4);
                $damage = $damageDice1 + $damageDice2;
                $npcDamagedHealth = $fight->getHealth() - $damage;

                $arrayRolls = [
                    "hit" => $hit,
                    "damageDice1" => $damageDice1,
                    "damageDice2" => $damageDice2,
                    "damage" => $damage,
                ];
                if ($npcDamagedHealth <= 0) {
                    $attacker = "end of battle";
                    //* npc dead, Supprimer le npc de la table Fight
                    $arrayNpc["npcHealth"] = 0;
                    $data = [
                        'player' => $arrayHero,
                        'npc' => $arrayNpc,
                        'dices' => $arrayRolls,
                        'attacker' => $attacker,
                    ];

                    $fight->setHero(null);
                    $fightDeleted = $fightRepository->remove($fight, true);

                    return $this->json200($data, ["game"]);
                } else {
                    //* npc stills alive ! On maj sa vie en Json + BDD et il devient attacker
                    $attacker = "npc";

                    $arrayNpc["npcHealth"] = $npcDamagedHealth;

                    $data = [
                        'player' => $arrayHero,
                        'npc' => $arrayNpc,
                        'dices' => $arrayRolls,
                        'attacker' => $attacker,
                    ];

                    $npcUpdate = $fight->setHealth($npcDamagedHealth);
                    
                    $fightRepository->add($fight, true);

                    return $this->json200($data, ["game"]);
                }
            } else {
                $hit = false;
                $attacker = "npc";
                $arrayRolls = [
                    "hit" => $hit,
                    "damageDice1" => null,
                    "damageDice2" => null,
                    "damage" => null,
                ];

                $data = [
                    'player' => $arrayHero,
                    'npc' => $arrayNpc,
                    'dices' => $arrayRolls,
                    'attacker' => $attacker,
                ];
                return $this->json200($data, ["game"]);
            }
        }
        // ----------------------------------------HERO END ATTACKER---------------------------------------------------

        // ----------------------------------------NPC START ATTACKER---------------------------------------------------
        elseif ($attackerName === "npc") {
            //* le npc frappe le hero
            // 1. Miss Or Not
            $higherStatAttacker = max($arrayNpc["npcStrength"], $arrayNpc["npcIntelligence"], $arrayNpc["npcDexterity"]);
            // On a besoin de la stat defense du hero
            $defenseHero = $hero->getDefense() + 3;
            // On lance un dé de (1-10) que l'on ajoute à la stat la plus haute du npc
            $diceAccurancy = rand(1, 10) + $higherStatAttacker;

            // Si le résultat est supérieur à la défense du hero
            if ($diceAccurancy >= $defenseHero) {
                $hit = true;
                $damageDice1 = rand(1, 4);
                $damageDice2 = rand(1, 4);
                $damage = $damageDice1 + $damageDice2;
                $heroDamagedHealth = $hero->getHealth() - $damage;

                $arrayRolls = [
                    "hit" => $hit,
                    "damageDice1" => $damageDice1,
                    "damageDice2" => $damageDice2,
                    "damage" => $damage,
                ];
                if ($heroDamagedHealth <= 0) {
                    $attacker = "end of battle";
                    //* hero dead, on annonce sa mort en JSON avec l'event Death et le résultat des dés
                    //* Le hero est mort durant le combat en recevant un coup
                    $newHeroHealthToApply = 0;
                    //* Maj vie du hero
                    $heroFightApplied = $hero->setHealth($newHeroHealthToApply);
                    //* Update en BDD
                    $heroRepository->add($heroFightApplied, true);

                    //! Supprimer le npc de la table Fight
                    $fight->setHero(null);
                    $fightDeleted = $fightRepository->remove($fight, true);

                    //* Il nous faut l'event Death
                    $eventTypeDeath = $eventTypeRepository->findOneBy(['name' => "Death"]);
                    $eventTypeDeathId = $eventTypeDeath->getId();
                    $eventDeath = $eventRepository->findOneBy(['eventType' => $eventTypeDeathId]);

                    $data = [
                        'player' => $hero,
                        'GameOver' => $eventDeath,
                        'dices' => $arrayRolls,
                        'attacker' => $attacker,
                    ];
                    return $this->json200($data, ["game"]);
                } else {
                    //* hero stills alive ! On maj sa vie en Json + BDD et il devient attacker
                    $attacker = "hero";

                    $arrayHero["health"] = $heroDamagedHealth;

                    $data = [
                        'player' => $arrayHero,
                        'npc' => $arrayNpc,
                        'dices' => $arrayRolls,
                        'attacker' => $attacker,
                    ];

                    $heroUpdate = $hero->setHealth($heroDamagedHealth);
                    $heroRepository->add($heroUpdate, true);
                    return $this->json200($data, ["game"]);
                }
            } else {
                $hit = false;
                $attacker = "hero";
                $arrayRolls = [
                    "hit" => $hit,
                    "damageDice1" => null,
                    "damageDice2" => null,
                    "damage" => null,
                ];

                $data = [
                    'player' => $arrayHero,
                    'npc' => $arrayNpc,
                    'dices' => $arrayRolls,
                    'attacker' => $attacker,
                ];
                return $this->json200($data, ["game"]);
            }
        }
        // ----------------------------------------NPC END ATTACKER---------------------------------------------------

        // ----------------------------------------ERROR URL PARAMETERS START---------------------------------------------------
        else {
            //! CAS ERREUR Paramètres URL non conforme
            $data = [
                'error' => "Something went wrong ! Check url's parameters ! ",
            ];
            return $this->json404($data);
        }
        // ----------------------------------------ERROR URL PARAMETERS END---------------------------------------------------

    }
}
