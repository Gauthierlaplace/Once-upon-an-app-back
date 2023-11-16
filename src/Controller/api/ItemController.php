<?php

namespace App\Controller\api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends CoreApiController
{
    /**
     *! Item is used,  
     *
     * 
     * @Route("/api/item/{itemId}", name="app_api_itemUsed" , requirements={"itemId"="\d+"}, methods={"GET"})
     */
    public function itemUsed($itemId): JsonResponse
    {
        dd($itemId);
    }
}

// On a besoin de : 
//1. 
//2.
//3.
//4.
//5.