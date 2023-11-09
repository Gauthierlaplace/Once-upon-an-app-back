<?php

namespace App\Services;

use App\Repository\HeroRepository;

class PlayedEventService
{
    /**
     *
     * @var HeroRepository
     */
    private $heroRepository;

    public function __construct(HeroRepository $heroRepository)
    {
        $this->heroRepository = $heroRepository;
    }

    /**
     * ! Save Event Played Id in playedEvent property from Hero table
     *
     * @param [object] $user current User
     * @param [int] $id id of an event
     * @return void
     */
    public function addEventToHero($user, $id)
    {
        $hero = $this->heroRepository->findOneBy(["user" => $user->getId()]);

        $playedEventArray = [];
        $playedEventArray = $hero->getPlayedEvent();
        $playedEventArray[] = $id;
        $hero->setPlayedEvent($playedEventArray);
        $this->heroRepository->add($hero, true);
    }

    /**
     * ! Get playedEvent Array from current User
     *
     * @param [object] $user
     * @return array $playedEventArray
     */
    public function getPlayedEventArray($user)
    {
        $hero = $this->heroRepository->findOneBy(["user" => $user->getId()]);
        $playedEventArray = $hero->getPlayedEvent();
        return $playedEventArray;
    }

    /**
     * ! Check EventId is unique or not in playedEventArray
     *
     * @param [int] $id
     * @param [object] $user
     * @return bool
     */
    public function checkEventIdIsUnique($id, $user)
    {
        $playedEventArray = $this->getPlayedEventArray($user);
        //TODO
        //! if $playedEventArray is null , on ne boucle pas, on considère que $id est unique donc on implémente $id à playedEventArray
        if ($playedEventArray === null) {
            $this->addEventToHero($user, $id);
        } else {
            foreach ($playedEventArray as $playedEventId) {
                if ($id === $playedEventId) {
                    // $id isn't unique
                    return false;
                } else {
                    // $id is unique, we can add it to $playedEventArray with function addEventToHero()
                    $this->addEventToHero($user, $id);
                    return true;
                }
            }
        }
    }

    /**
     * ! Reset playedEvent property from Hero Table when hero dies
     *
     * @param [object] $user current user
     * @return void
     */
    public function resetPlayedEventToHero($user)
    {
        $hero = $this->heroRepository->findOneBy(["user" => $user->getId()]);
        $hero->setPlayedEvent(null);
        $this->heroRepository->add($hero, true);
    }
}
