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
     * @Route("/api/event/fight/{npcId}/attack/{effectId}", name="app_api_attack" , requirements={"effectId"="\d+", "npcId"="\d+"}, methods={"GET"})
     */
    public function attackOrMiss($effectId, $npcId, NpcRepository $npcRepository, EffectRepository $effectRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
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

        
        //! L'attaquant $attacker doit déterminer s'il touche ou pas 
        //! fonction 2 params -> attacker(hero ou npc), defender(hero ou npc)
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

}
