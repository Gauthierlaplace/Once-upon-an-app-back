<?php

namespace App\Controller\api;

use Doctrine\ORM\EntityNotFoundException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CoreApiController extends AbstractController
{
    /** @var SerializerInterface $serializer */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function json200($data, array $groups): JsonResponse
    {
        return $this->json(
            // les données
            $data, 
            // le code de retour : 200 par défaut
            Response::HTTP_OK,
            // les entêtes HTTP, on ne s'en sert pas : []
            [],
            // le contexte de serialisation : les groupes
            [
                // on précise les groupes                
                "groups" => 
                // c'est un tableau indexé, avec les noms de groupes
                $groups
            ]
        );
    }

    public function json201($data, array $groups): JsonResponse
    {
        return $this->json(
            // les données
            $data, 
            // le code 201 pour la création
            Response::HTTP_CREATED,
            // les entêtes HTTP, on ne s'en sert pas : []
            [],
            // le contexte de serialisation : les groupes
            [
                // on précise les groupes                
                "groups" => 
                // c'est un tableau indexé, avec les noms de groupes
                $groups
            ]
        );
    }

    public function json404($data): JsonResponse
    {
        // ! on est dans une API donc pas de HTML
            // throw $this->createNotFoundException();
            return $this->json(
                // on pense UX : on fournit un message
                $data,
                // le code de status : 404
                Response::HTTP_NOT_FOUND
                // on a pas besoin de preciser les autres arguments
            );
    }

    public function deserialiseJson($jsonContent, string $className)
    {
        // Désérialiser (convertir) le JSON en entité Doctrine Movie
        try { // on tente de désérialiser
            $entity = $this->serializer->deserialize($jsonContent, $className, 'json');
        } catch (EntityNotFoundException $e){
            // spécial pour DoctrineDenormalizer
            return $this->json("Denormalisation : ". $e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception){
            // Si on n'y arrive pas, on passe ici
            // dd($exception);
            // code 400 ou 422
            return $this->json("JSON Invalide : " . $exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $entity;
    }
}