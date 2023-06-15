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
        
        // TODO Récupérer l'EventA($eventA) Event : Départ Biome 1 (`SELECT `title` FROM `event` WHERE `title` === "Départ Biome 1"` )

        // TODO On a besoin de l'ID de EventA pour aller chercher les Endings correspondant 
        // $eventAId

        // TODO Des x event_typeId issue des endings de l'eventA, on en prend 2 en random event_type
        // Random mysql ou Dsql 

        // TODO Une fois les 2 random event_type pris, faire un random par event_type de Biome correspondant pour avoir l'id EventB et l'id EventC

        // TODO De l'eventB et l'eventC stocker l'opening de chacun (BTN choice next Event (B ou C))

        // TODO Nouvelle route nécessaire pour la suite, donc nouvelle fonction :)




        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/GameController.php',
        ]);
    }
}
