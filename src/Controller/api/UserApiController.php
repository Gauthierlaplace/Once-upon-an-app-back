<?php

namespace App\Controller\api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserApiController extends CoreApiController
{

    // TODO Connexion
    /**
     * @Route("/api/users/{partialEmail}", name="app_api_users", methods={"GET"})
     */
    public function connectUser($partialEmail, UserRepository $userRepository, Request $request)
    {
        $partialEmail = $request->attributes->get('partialEmail');

        $user = $userRepository->findOneByEmail($partialEmail);

        if ($user === null) {
            return $this->json404(["message" => "Aucun utilisateur trouvé !"]);
        }

        return $this->json200($user, ["user_connect"]);

        // TODO trouver comment sécurisé la requete (2 emails presque identiques)

    }

    // TODO Read one user
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

    // TODO Delete one user
}
