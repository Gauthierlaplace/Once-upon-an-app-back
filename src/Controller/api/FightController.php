<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends CoreApiController
{
    /**
     * @Route("/api/event/fight/attack/{id}", name="app_api_attack" , requirements={"id"="\d+"}, methods={"GET"})
     */
    public function attackOrMiss(): JsonResponse
    {
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        // Hero vie 20 de base
        // Npc vie 10 de base
        
        // TODO 
        //! Sauvegarder la Vie Max du NPC (propriété de table à créer maxHealth)
        //* Déterminer qui commencera le combat en fonction de l'id de l'effet
        // ! id = id de l'effet
        // si l'effet est positif on influe sur la vie du NPC, le Npc attaque en premier
        // si l'effet est négatif on influe sur la vie du Player, le Player attaque en premier


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
            'player' => $hero,

        ];
        return $this->json200($data, ["fight"]);
    }
}
