<?php

namespace App\Controller\api;

use App\Repository\HeroRepository;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemApiController extends CoreApiController
{
    /**
     *! Item is usable, applies on hero stats and delete item used from hero inventory
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

                    if ($itemUsed->isUsable()) {
                        //! Health
                        if ($itemUsed->getHealth()) {
                            if ($itemUsed->getHealth()) {
                                $hero->setHealth($hero->getHealth() + $itemUsed->getHealth());
                                if ($hero->getHealth() >= $hero->getMaxHealth()) {
                                    $hero->setHealth($hero->getMaxHealth());
                                }
                            }
                        }
                        //! Strength
                        if ($itemUsed->getStrength()) {
                            $hero->setStrength($hero->getStrength() + $itemUsed->getStrength());
                        }
                        //! Intelligence
                        if ($itemUsed->getIntelligence()) {
                            $hero->setIntelligence($hero->getIntelligence() + $itemUsed->getIntelligence());
                        }
                        //! Dexterity
                        if ($itemUsed->getDexterity()) {
                            $hero->setDexterity($hero->getDexterity() + $itemUsed->getDexterity());
                        }
                        //! Defense
                        if ($itemUsed->getDefense()) {
                            $hero->setDefense($hero->getDefense() + $itemUsed->getDefense());
                        }
                        //! Karma
                        if ($itemUsed->getKarma()) {
                            $hero->setKarma($hero->getKarma() + $itemUsed->getKarma());
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
