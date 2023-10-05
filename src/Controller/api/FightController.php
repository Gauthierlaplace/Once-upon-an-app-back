<?php

namespace App\Controller\api;

use App\Repository\EffectRepository;
use App\Repository\HeroRepository;
use App\Repository\NpcRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends CoreApiController
{
    /**
     * @Route("/api/event/fight/{npcId}/attack/{effectId}", name="app_api_attack" , requirements={"effectId"="\d+", "npcId"="\d+"}, methods={"GET"})
     */
    public function attackOrMiss($effectId, $npcId, NpcRepository $npcRepository, EffectRepository $effectRepository, HeroRepository $heroRepository): JsonResponse
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

        // TODO 
        //* Déterminer qui commencera le combat en fonction de l'id de l'effet
        // si l'effet est positif on influe sur la vie du NPC, le Npc attaque en premier
        // si l'effet est négatif on influe sur la vie du Player, le Player attaque en premier
        $effectHealth = $effect->getHealth();
        // dump($effectHealth);
        $heroCurrentHealth = $arrayHero['heroHealth'];
        $npcCurrentHealth = $arrayNpc['npcHealth'];
        
        if ($effectHealth <= 0) {
            // on tape le Héro et on le MAJ en BDD
            $hero = $heroRepository->find($arrayHero['heroId']);
            $arrayHero['heroHealth'] = $hero->setHealth($heroCurrentHealth + $effectHealth);
        } else {
            // on tape le npc et on MAJ en BDD
            $npc = $npcRepository->find($arrayNpc['npcId']);
            
            $arrayNpc['npcHealth'] = $npc->setHealth($npcCurrentHealth - $effectHealth);
        }
        
        // dd($arrayNpc['npcHealth']);


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





        $data = [
            'hero' => $arrayHero,
            'npc' => $arrayNpc,
            'effect' => $arrayEffect,
            'attacker' => "hero ou npc",
            'defender' => "hero ou npc",
        ];


        return $this->json200($data, ["game"]);
    }
}
