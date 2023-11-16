<?php

namespace App\Controller\api;

use App\Repository\HeroRepository;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends CoreApiController
{
    /**
     *! Item is usable, applies on hero stats and delete item from hero inventory
     *
     * @Route("/api/usable/{itemId}", name="app_api_usable" , requirements={"itemId"="\d+"}, methods={"GET"})
     */
    public function usable($itemId, ItemRepository $itemRepository, HeroRepository $heroRepository): JsonResponse
    {
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        $heroesCollection = $user->getHeroes();
        $heroes = $heroesCollection->toArray();

        $arrayHero = [];
        foreach ($heroes as $hero) {

            $itemCollection = $hero->getItem();
            $items = $itemCollection->toArray();

            foreach ($items as $key => $item) {
                if ($item->getId() == $itemId) {

                    $itemUsed = $itemRepository->find($itemId);
                    // TODO check usable function is ok with it, probably this one under ;)
                    // if ($itemUsed->getHealth() && $itemUsed->getUsable() == true) {
                    if ($itemUsed->getHealth()) {
                        $hero->setHealth($hero->getHealth() + $itemUsed->getHealth());

                        if ($hero->getHealth() >= $hero->getMaxHealth()) {
                            $hero->setHealth($hero->getMaxHealth());
                        }
                        unset($items[$key]);
                        $itemCollection->removeElement($itemUsed);
                        $hero->removeItem($itemUsed);
                        $heroRepository->add($hero, true);
                    }
                }
            }

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
                'heroItems' => $items,
            ];
        }

        $data = [
            'player' => $arrayHero,
        ];

        return $this->json200($data, ["game"]);
    }
}

// On veut : Utiliser une potion

// On a besoin de : 
//1. Ajouter un item à un npc dans la table Fight 
//2. Si le npc meurt, le hero gagne l'item du npc de la table Fight
//3. Utiliser une potion
//4. Obtenir l'inventaire du hero (service)
//5.