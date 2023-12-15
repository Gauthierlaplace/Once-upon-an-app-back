<?php

namespace App\Controller\api;

use App\Entity\Review;
use App\Repository\ReviewRepository;
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

        return $this->json200($allReviews, ["review"]);
    }

    /**
     * Read one review
     * 
     * @Route("/api/reviews/{id}", name="app_api_reviews_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read($id, ReviewRepository $reviewRepository): JsonResponse
    {
        $review = $reviewRepository->find($id);

        if ($review === null) {
            return $this->json404(["message" => "Cet avis n'existe pas"]);
        }
        return $this->json200($review, ["review"]);
    }

    /**
     * Last x reviews
     *
     * @Route("/api/reviews/lastest/{x}",name="app_api_reviews_lastest", requirements={"x"="\d+"}, methods={"GET"})
     *
     * @param ReviewRepository $reviewRepository
     */
    public function lastestReviews($x, ReviewRepository $reviewRepository): JsonResponse
    {
        $lastestReviews = $reviewRepository->findLastestReviews($x);

        return $this->json200($lastestReviews, ["review"]);
    }

    /**
     * General Rating
     *
     * @Route("/api/rating",name="app_api_rating", methods={"GET"})
     *
     * @param ReviewRepository $reviewRepository
     */
    public function rating(ReviewRepository $reviewRepository): JsonResponse
    {
        $allReviews = $reviewRepository->findAll();

        $allRating = [];
        $count = null;
        $ratingCount = null;
        if (!empty($allReviews)) {
            foreach ($allReviews as $review) {
                $allRating [] = $review->getRating();
    
                $ratingCount = $review->getRating() + $ratingCount;
    
                $count = $count + 1;
            }
            $generalRating = ["rating" => $ratingCount / $count];
            return $this->json200($generalRating, ["rating"]);
        }
        $generalRating = ["rating" => 0];
        return $this->json200($generalRating, ["rating"]);
    }

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
        $jsonContent = $request->getContent();

        // Désérialiser (convertir) le JSON en entité Doctrine Review
        try { 
            $review = $serializer->deserialize($jsonContent, Review::class, 'json');
        } catch (Exception $exception) {
            return $this->json("JSON Invalide : " . $exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        $errors = $validator->validate($review);

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $reviewToCreate = new Review();
        $reviewToCreate->setTitle($review->getTitle());
        $reviewToCreate->setContent($review->getContent());
        $reviewToCreate->setRating($review->getRating());
        $reviewToCreate->setUser($review->getUser());
        $reviewToCreate->setCreatedAt(new DateTime("now"));
        $reviewToCreate->setUpdatedAt(new DateTime("now"));

        $reviewRepository->add($reviewToCreate, true);

        return $this->json201($reviewToCreate, ["review"]);
    }

    /**
     * Edit Review, only review's author is allowed to change it
     *
     * @Route("/api/reviews/{id}",name="app_api_reviews_edit", requirements={"id"="\d+"}, methods={"PUT"})
     * 
     * @param Request $request la requete
     * @param SerializerInterface $serializerInterface
     * @param ReviewRepository $reviewRepository
     */
    public function edit($id, Request $request, SerializerInterface $serializerInterface, ReviewRepository $reviewRepository)
    {
        $jsonContent = $request->getContent();
        $review = $reviewRepository->find($id);

        if ($review == null) {
            return $this->json404(["message" => "Cet avis n'existe pas"]);
        }

        $serializerInterface->deserialize(
            $jsonContent,
            Review::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $review]
        );

        $review->setUpdatedAt(new DateTime("now"));

        /** @var App\Entity\User $currentUser */
        $currentUser = $this->getUser();
        
        $currentUserId = $currentUser->getId();

        $reviewOwner = $review->getUser()->getId();

        if ($currentUserId == $reviewOwner) {
            $reviewRepository->add($review, true);
            return $this->json200($review, ["review"]);
        } else {
            return $this->json403(["message" => "Vous n'êtes pas l'auteur de cet avis, vous ne pouvez l'éditer."]);
        }
    }

    /**
     * Delete Review, review's author only 
     *
     * @Route("/api/reviews/{id}",name="app_api_reviews_delete", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, ReviewRepository $reviewRepository)
    {
        $review = $reviewRepository->find($id);

        if ($review == null) {
            return $this->json404(["message" => "Cet avis n'existe pas"]);
        }

        /** @var App\Entity\User $currentUser */
        $currentUser = $this->getUser();
        $currentUserId = $currentUser->getId();
        
        $reviewOwner = $review->getUser()->getId();

        if ($currentUserId == $reviewOwner) {

            $reviewRepository->remove($review, true);

            return $this->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return $this->json403(["message" => "Vous n'êtes pas l'auteur de cet avis, vous ne pouvez pas le supprimer."]);
        }
    }
}
