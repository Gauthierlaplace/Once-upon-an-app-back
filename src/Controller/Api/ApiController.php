<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="app_api_")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(): JsonResponse
    {
        return $this->json([
            'message' => "Bonjour ! Bienvenue sur l'API RPG",
        ]);
    }
}


