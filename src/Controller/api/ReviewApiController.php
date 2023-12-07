<?php

namespace App\Controller\api;

use App\Entity\User;
use App\Entity\Review;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use DateTime;

class ReviewApiController extends CoreApiController
{
    //TODO 
    // !! 1. Browse
    /**
     * Browse all reviews
     *
     * @Route("/api/reviews",name="app_api_reviews_browse", methods={"GET"})
     *
     * @param ReviewRepository $reviewRepository
     */
    public function browse(ReviewRepository $reviewRepository): JsonResponse
    {
        $allReviews = $reviewRepository->findAll();

        return $this->json200($allReviews, ["review_browse"]);
    }
    // !! 2. Read
    /**
     * @Route("/api/reviews/{id}", name="app_api_reviews_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read($id, ReviewRepository $reviewRepository): JsonResponse
    {
        $review = $reviewRepository->find($id);

        if ($review === null) {
            return $this->json404(["message" => "Cet avis n'existe pas"]);
        }
        return $this->json200($review, ["review_read"]);
    }

    // !! 3. Last 5 Reviews
    // !! 4. General Rating

    // !! 5. Create
    /**
     * New review
     *
     * @Route("/api/reviews",name="app_api_reviews_add", methods={"POST"})
     * 
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param ReviewRepository $reviewRepository
     */
    public function add(
        Request $request,
        ReviewRepository $reviewRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
    ) {
        // Récupérer le contenu JSON
        $jsonContent = $request->getContent();

        // Désérialiser (convertir) le JSON en entité Doctrine Review
        try { // on tente de désérialiser
            $review = $serializer->deserialize($jsonContent, Review::class, 'json');
        } catch (Exception $exception) {
            // Si on n'y arrive pas, on passe ici
            // code 400 ou 422
            return $this->json("JSON Invalide : " . $exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        // on valide les données de notre entité
        $errors = $validator->validate($review);
        // Y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $reviewToCreate = new Review();
        $reviewToCreate->setTitle($review->getTitle());
        $reviewToCreate->setContent($review->getContent());
        $reviewToCreate->setRating($review->getRating());
        $reviewToCreate->setUser($review->getUser());
        $reviewToCreate->setCreatedAt(new DateTime("now"));

        // On sauvegarde les entitées
        $reviewCreated = $reviewRepository->add($reviewToCreate, true);

        return $this->json201($reviewToCreate, ["review_create"]);
    }

    // !! 6. Edit
    // !! 7. Delete



}
