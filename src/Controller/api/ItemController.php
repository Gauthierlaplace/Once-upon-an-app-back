<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends CoreApiController
{
    /**
     *
     * @Route("/api/item/{itemId}", name="app_api_introAttack" , requirements={"itemId"="\d+"}, methods={"GET"})
     */
    public function introAttack($effectId, $npcId, FightRepository $fightRepository, PlayedEventService $playedEventService, NpcRepository $npcRepository, EffectRepository $effectRepository, HeroRepository $heroRepository, EventRepository $eventRepository, EventTypeRepository $eventTypeRepository): JsonResponse
    {