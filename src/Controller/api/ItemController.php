<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends CoreApiController
{
    /**
     *
     * @Route("/api/item/{itemId}", name="app_api_introAttack" , requirements={"itemId"="\d+"}, methods={"GET"})
     */
    public function itemUsed($itemId): JsonResponse 
    {
        dd($itemId);
    }
}