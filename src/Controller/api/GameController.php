<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/api/play", name="app_api_game")
     */
    public function btnPlay(): JsonResponse
    {
        // TODO Arrivée Event Départ du Biome 1 , 1er noeud de choix d'ending
        // un random EventA Départ + opening de 2 random Event(BetC)de event_type issue de la table ending de l' EventA











        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/GameController.php',
        ]);
    }
}
