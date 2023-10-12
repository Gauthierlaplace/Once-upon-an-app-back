<?php

namespace App\Controller\api;

use App\Repository\EffectRepository;
use App\Repository\EventRepository;
use App\Repository\EventTypeRepository;
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
    public function introAttack($effectId, $npcId, NpcRepository $npcRepository, EffectRepository $effectRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
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
                'heroHealth' => $hero->getHealth(),
                'heroStrength' => $hero->getStrength(),
                'heroIntelligence' => $hero->getIntelligence(),
                'heroDexterity' => $hero->getDexterity(),
                'heroDefense' => $hero->getDefense(),
                'heroKarma' => $hero->getKarma(),
            ];
        }

        $npc = $npcRepository->find($npcId);

        $arrayNpc = [
            'npcId' => $npc->getId(),
            'npcName' => $npc->getName(),
            'npcMaxHealth' => $npc->getMaxHealth(),
            'npcHealth' => $npc->getHealth(),
            'npcStrength' => $npc->getStrength(),
            'npcIntelligence' => $npc->getIntelligence(),
            'npcDexterity' => $npc->getDexterity(),
            'npcDefense' => $npc->getDefense(),
            'npcKarma' => $npc->getKarma(),
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
            $newHeroHealthToApply = $arrayHero['heroHealth'] + $arrayEffect['effectHealth'];
            //*On vérifie que le hero survit
            if ($newHeroHealthToApply <= 0) {
                //* Le hero est mort durant l'application de l'effet introduisant le combat
                $newHeroHealthToApply = 0;
                //* Maj vie du hero
                $heroEffectApplied = $heroToApplyEffect->setHealth($newHeroHealthToApply);
                //* Update en BDD
                $heroUpdated = $heroRepository->add($heroEffectApplied, true);

                //* On reset la vie du npc
                //! Supprimer le npc de la table combat (To Build)
                $npcReset = $npc->setHealth($npc->getMaxHealth());
                $npcRepository->add($npcReset, true);

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

            $arrayHero['heroHealth'] = $newHeroHealthToApply;
            $attacker = "hero";
        } else {
            //* on tape le npc et on MAJ en BDD
            //! Futur MAJ NPC sur table COMBAT (correctif)
            //*on détermine la santé du npc en appliquant l'effet
            $newNpcHealthToApply = $arrayNpc['npcHealth'] - $arrayEffect['effectHealth'];

            //*On vérifie que le npc survit
            if ($newNpcHealthToApply <= 0) {
                //* Le npc est mort durant l'application de l'effet introduisant le combat

                //* Reset vie du npc le combat est terminé
                $npcEffectApplied = $npc->setHealth($npc->getMaxHealth());
                //* Update en BDD
                $npcUpdated = $npcRepository->add($npcEffectApplied, true);

                //* On reset la vie du npc
                //! Supprimer le npc de la table combat (To Build)
                $npcReset = $npc->setHealth($npc->getMaxHealth());
                $npcRepository->add($npcReset, true);
                $arrayNpc['npcHealth'] = $newNpcHealthToApply;
                $attacker = "end of battle";
            } else {
                //* Le npc a survécu à l'effet, on applique le modification de health
                //* Maj vie du npc
                $npcEffectApplied = $npc->setHealth($newNpcHealthToApply);
                //* Update en BDD
                $npcUpdated = $npcRepository->add($npcEffectApplied, true);
                $arrayNpc['npcHealth'] = $newNpcHealthToApply;
                $attacker = "npc";
            }
        }

        $data = [
            'hero' => $arrayHero,
            'npc' => $arrayNpc,
            'effect' => $arrayEffect,
            'attacker' => $attacker,
        ];

        return $this->json200($data, ["game"]);
    }


    //TODO ! NEXT ! FIGHT ! PHASE 2 !
    /**
     * ! Combat Phase 2 : 
     *
     * @Route("/api/event/fight/{npcId}/attacker/{attackerName}", name="app_api_attack" , requirements={"npcId"="\d+", "attackerName"="\w+"}, methods={"GET"})
     */
    public function attack($npcId, $attackerName, NpcRepository $npcRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
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
                'heroHealth' => $hero->getHealth(),
                'heroStrength' => $hero->getStrength(),
                'heroIntelligence' => $hero->getIntelligence(),
                'heroDexterity' => $hero->getDexterity(),
                'heroDefense' => $hero->getDefense(),
                'heroKarma' => $hero->getKarma(),
            ];
        }

        $npc = $npcRepository->find($npcId);

        $arrayNpc = [
            'npcId' => $npc->getId(),
            'npcName' => $npc->getName(),
            'npcMaxHealth' => $npc->getMaxHealth(),
            'npcHealth' => $npc->getHealth(),
            'npcStrength' => $npc->getStrength(),
            'npcIntelligence' => $npc->getIntelligence(),
            'npcDexterity' => $npc->getDexterity(),
            'npcDefense' => $npc->getDefense(),
            'npcKarma' => $npc->getKarma(),
        ];

        //* Tableau de stockage des résultats de roll
        $arrayRolls = [];


        //* Phase 1 -> $attackerName frappe l'autre personnage
        if ($attackerName === "hero") {
            //* le hero frappe le npc

            // 1. Miss Or Not
            // On a besoin de récupérer la stat la plus haute entre strenght, intelligence et dexterity du hero
            $higherStatAttacker = max($arrayHero["heroStrength"], $arrayHero["heroIntelligence"], $arrayHero["heroDexterity"]);
            // On a besoin de la stat defense du npc
            $defenseNpc = $npc->getDefense() + 3;

            // On lance un dé de (1-10) que l'on ajoute à la stat la plus haute du hero
            $diceAccurancy = rand(1, 10) + $higherStatAttacker;

            // Si le résultat est supérieur à la défense du npc, alors on passe en 2.
            if ($diceAccurancy >= $defenseNpc) {
                $hit = true;
                $damageDice1 = rand(1, 4);
                $damageDice2 = rand(1, 4);
                $damage = $damageDice1 + $damageDice2;
                $npcDamagedHealth = $npc->getHealth() - $damage;
//! TODO
                if ($npcDamagedHealth <= 0) {
                    $arrayRolls = [
                        "hit" => $hit,
                        "damageDice1" => $damageDice1,
                        "damageDice2" => $damageDice2,
                        "damage" => $damage,
                    ];
                    $attacker = "end of battle";
                    //* npc dead, on reset sa vie et on annonce sa mort en JSON
                    //* On reset la vie du npc en bdd
                    //! Supprimer le npc de la table combat (To Build)
                    $data = [
                        'hero' => $arrayHero,
                        'npc' => $arrayNpc,
                        'dices' => $arrayRolls,
                        'nextAttacker' => $attacker,
                    ];
                    $npcReset = $npc->setHealth($npc->getMaxHealth());
                    $npcRepository->add($npcReset, true);
                    return $this->json200($data, ["game"]);
                } else {
                    //* npc stills alive ! On maj sa vie en Json + BDD et il devient attacker
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
                    'hero' => $arrayHero,
                    'npc' => $arrayNpc,
                    'dices' => $arrayRolls,
                    'nextAttacker' => $attacker,
                ];
                return $this->json200($data, ["game"]);
            }

            // 2. Damage to npc

            // stock résultat $arrayRolls
            // apply damage

            // 3. Npc survived or not
            // On vérifie la survie du npc
            // On met à jour la BDD ou on reset le npc s'il meurt

            // 4. Return or not

            //* si le npc survit : il devient $attacker
            $attacker = "npc";
            //* si le npc meurt : fin du combat
            $attacker = "end of battle";
        } elseif ($attackerName === "npc") {
            //* le npc frappe le hero
            // 1. Miss Or Not
            // On a besoin de récupérer la stat la plus haute entre strenght, intelligence et dexterity du npc
            // On a besoin de la stat defense du hero
            // On lance un dé de (1-10) que l'on ajoute à la stat la plus haute du npc
            // Si le résultat est supérieur à la défense du hero, alors on passe en 2.
            // stock résultat $arrayRolls

            // 2. Damage to hero
            // On lance 2 dés de (1-4) qui détermine les dégats à appliquer au hero
            $damageDice1 = rand(1, 4);
            $damageDice2 = rand(1, 4);
            $damage = $damageDice1 + $damageDice2;
            // stock résultat $arrayRolls
            // apply damage

            // 3. Hero survived or not
            // On vérifie la survie du hero
            // On met à jour la BDD et l'on renvoie un Death Event adapté s'il meurt
            // On reset le npc

            // 4. Return or not

            //* si le hero survit : il devient $attacker
            $attacker = "hero";
            //* si le hero meurt : fin du combat
            $attacker = "end of battle";
        } else {
        }


        $arrayRolls = [
            "hit" => $hit,
            "damageDice1" => $damageDice1,
            "damageDice2" => $damageDice2,
            "damage" => $damage,

        ];

        $data = [
            'hero' => $arrayHero,
            'npc' => $arrayNpc,
            'dices' => $arrayRolls,
            'nextAttacker' => $attacker,
        ];
        // dd($data);
        return $this->json200($data, ["game"]);
    }
}


    //! L'attaquant $attacker doit déterminer s'il touche ou pas 
    // lancement de dés (1-10) = (rand(1-10)) + mainStatAttacker
    // mainStatAttacker = stat la plus haute parmis la force-intelligence-dexterity
    // defensiveStatDefender = stat defense de la personne qui prendra le coup

    // exemple
    // mainStatAttacker = 10 + rand(1-10) =  si le rand : 1-2 c'est loupé (80% chance de réussite)
    // defensiveStatDefender = 12 


    //! Apply Damage si touche
    // si $mainStatAttacker > $defensiveStatDefender alors on doit déterminer le dégat a appliquer au defender
    // damage = rand(1-4) + rand(1-4)
    // DefenderHealth = health - damage

    //! Check Health not 0
    // Vérifier la survie du Defender, s'il survit le defender devient l'attacker (Reappel de la fonction2params(attacker, defender))
    // Si le defender meurt : 
    // - c'est le héro: on renvoie la vie du héro et reset la vie npc
    // - c'est le Npc: On renvoie la vie npc et la vie du héro puis on reset la vie Npc fin du combat
