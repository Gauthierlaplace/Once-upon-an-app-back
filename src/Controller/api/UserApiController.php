<?php

namespace App\Controller\api;

use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserApiController extends CoreApiController
{

    // TODO Connexion (useless)
    // /**
    //  * @Route("/api/users/{partialEmail}", name="app_api_users", methods={"GET"})
    //  */
    // public function connectUser($partialEmail, UserRepository $userRepository, Request $request)
    // {
    //     $partialEmail = $request->attributes->get('partialEmail');

    //     $user = $userRepository->findOneByEmail($partialEmail);

    //     if ($user === null) {
    //         return $this->json404(["message" => "Aucun utilisateur trouvé !"]);
    //     }

    //     return $this->json200($user, ["user_connect"]);

    //     // TODO trouver comment sécurisé la requete (2 emails presque identiques)

    // }

    // TODO Read one user (useless)
    // /**
    //  * @Route("/api/user/{id}", name="app_api_user_read", requirements={"id"="\d+"}, methods={"GET"})
    //  */
    // public function read($id, UserRepository $userRepository): JsonResponse
    // {
    //     $user = $userRepository->find($id);
    //     // gestion 404
    //     if ($user === null) {
    //         return $this->json404(["message" => "Cet utilisateur n'existe pas"]);
    //     }

    //     return $this->json200($user, ["user_read"]);
    // }

    // TODO Edit one user

    // TODO Add one user
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
        ValidatorInterface $validatorInterface
    ) {
        // Récupérer le contenu JSON
        $jsonContent = $request->getContent();
        // Désérialiser (convertir) le JSON en entité Doctrine User
        try { // on tente de désérialiser
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
        } catch (Exception $exception) {
            // Si on n'y arrive pas, on passe ici
            // dd($exception);
            // code 400 ou 422
            return $this->json("JSON Invalide", Response::HTTP_BAD_REQUEST);
        }

        // on valide les données de notre entité
        $errors = $validatorInterface->validate($user);
        // Y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // On sauvegarde l'entité
        $userRepository->add($user, true);

        return $this->json201($user, ["user_create"]);
    }

    // TODO Delete one user


    // TODO CurrentUser details from JWT Token    (DONE)
    /**
     * Route giving CurrentUser details from JWT Token 
     * 
     * @Route("/api/users/details", name="user_details", methods={"GET"})
     */
    public function currentUser(): JsonResponse
    {
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        // Vérifiez si l'utilisateur est authentifié
        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non authentifié.'], 401);
        }
        // dd($user);
        // Récupérez les détails de l'utilisateur connecté
        $userId = $user->getId();
        $email = $user->getEmail();
        $pseudo = $user->getPseudo();
        $avatar = $user->getAvatar();

        // Retournez les détails de l'utilisateur au format JSON
        return new JsonResponse([
            'id' => $userId,
            'email' => $email,
            'pseudo' => $pseudo,
            'avatar' => $avatar,
        ]);
    }
}
