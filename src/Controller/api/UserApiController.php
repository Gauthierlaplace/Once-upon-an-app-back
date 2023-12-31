<?php

namespace App\Controller\api;

use App\Entity\Hero;
use App\Entity\User;
use App\Repository\HeroClassRepository;
use App\Repository\HeroRepository;
use App\Repository\PictureRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserApiController extends CoreApiController
{

    // ! Pas de Browse

    // ! Read alias currentUser
    /**
     * Route giving CurrentUser details from JWT Token 
     * 
     * @Route("/api/users/details", name="app_api_users_details", methods={"GET"})
     */
    public function currentUser(): JsonResponse
    {
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        // Vérifiez si l'utilisateur est authentifié
        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non authentifié.'], 401);
        }

        // Récupérez les détails de l'utilisateur connecté
        $userId = $user->getId();
        $email = $user->getEmail();
        $pseudo = $user->getPseudo();
        $avatarId = $user->getAvatar()->getId();
        $avatarPath = $user->getAvatar()->getPath();

        // Retournez les détails de l'utilisateur au format JSON
        return new JsonResponse([
            'id' => $userId,
            'email' => $email,
            'pseudo' => $pseudo,
            'avatarId' => $avatarId,
            'avatarPath' => $avatarPath,
        ]);
    }

    // ! Add one user
    /**
     * New user
     *
     * @Route("/api/users",name="app_api_users_add", methods={"POST"})
     * 
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param UserRepository $userRepository
     */
    public function add(
        Request $request,
        UserRepository $userRepository,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
        HeroRepository $heroRepository,
        HeroClassRepository $heroClassRepository,
        PictureRepository $pictureRepository
    ) {
        // Récupérer le contenu JSON
        $jsonContent = $request->getContent();
        // Désérialiser (convertir) le JSON en entité Doctrine User
        try { // on tente de désérialiser
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
        } catch (Exception $exception) {
            // Si on n'y arrive pas, on passe ici
            // code 400 ou 422
            return $this->json("JSON Invalide", Response::HTTP_BAD_REQUEST);
        }

        // on valide les données de notre entité
        $errors = $validator->validate($user);
        // Y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $plainPassword = $user->getPassword();
        if (!empty($plainPassword)) {
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);

            $user->setPassword($hashedPassword);
        }
        $heroClass = $heroClassRepository->findOneBy(['id' => 2]);
        $defaultAvatar = $pictureRepository->findOneBy(["name" => 'Default Hero Avatar']);
        
        $hero = new Hero();
        $hero->setName($user->getPseudo());
        $hero->setMaxHealth($heroClass->getMaxHealth());
        $hero->setHealth($heroClass->getHealth());
        $hero->setStrength($heroClass->getStrength());
        $hero->setIntelligence($heroClass->getIntelligence());
        $hero->setDexterity($heroClass->getDexterity());
        $hero->setDefense($heroClass->getDefense());
        $hero->setKarma(rand(0, 10));
        $hero->setXp(0);
        $hero->setPicture($defaultAvatar)->getName();
        $hero->setProgress(0);
        $hero->setHeroClass($heroClass);
        $hero->setUser($user);
        
        $user->setRoles(["ROLE_PLAYER"]);
        $user->setAvatar($defaultAvatar);
        
  
        // On sauvegarde les entitées
        $userRepository->add($user, true);
        $heroRepository->add($hero, true);

        return $this->json201($user, ["user_create"]);
    }

    // ! Edit one user

    /**
     * edit user
     *
     * @Route("/api/users/{id}",name="app_api_users_edit", requirements={"id"="\d+"}, methods={"PUT"})
     * 
     * @param Request $request la requete
     * @param SerializerInterface $serializerInterface
     * @param UserRepository $userRepository
     */
    public function edit(
        $id,
        Request $request,
        SerializerInterface $serializerInterface,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator,
        HeroRepository $heroRepository
    ) {
        $jsonContent = $request->getContent();
        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('Utilisateur non trouvé', Response::HTTP_NOT_FOUND);
        }

        $plainPassword = $user->getPassword();

        $serializeUser = $serializerInterface->deserialize(
            $jsonContent,
            User::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $user]
        );

        // on valide les données de notre entité
        $errors = $validator->validate($user);
        // Y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $serializePassword = $serializeUser->getPassword();

        if (!empty($plainPassword && $plainPassword !== $serializePassword)) {
            $hashedPassword = $passwordHasher->hashPassword($serializeUser, $serializePassword);

            $user->setPassword($hashedPassword);
        }

        $heroesArray = $heroRepository->findByUser($id);
        foreach ($heroesArray as $heroArray) {
           $heroToUpdate = $heroArray->setName($user->getPseudo());
           $updatedUser = $user->addHero($heroToUpdate);
        }
        $userRepository->add($updatedUser, true);

        return $this->json200($user, ["user_read"]);
    }

    /**
     * delete user
     *
     * @Route("/api/users/{id}",name="app_api_users_delete", requirements={"id"="\d+"}, methods={"DELETE"})
     */
    public function delete($id, userRepository $userRepository, ReviewRepository $reviewRepository, HeroRepository $heroRepository)
    {
        $allReviews = $reviewRepository->findByUser($id);

        foreach ($allReviews as $Review) {
            $reviewRepository->remove($Review);
        }

        $allheros = $heroRepository->findByUser($id);

        foreach ($allheros as $hero) {
            $heroRepository->remove($hero);
        }

        $user = $userRepository->find($id);
        $userRepository->remove($user, true);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
