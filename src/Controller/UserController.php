<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\HeroRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'email de l'utilisateur
            $email = $user->getEmail();

            // Vérifier si un enregistrement avec le même email existe déjà
            $existingUser = $userRepository->findOneBy(['email' => $email]);
            if ($existingUser) {
                $errorMessage = 'Un utilisateur avec le même email existe déjà. Veuillez choisir un email différent.';
                return new Response($errorMessage, Response::HTTP_BAD_REQUEST);
            }

            // On récupère le mot de passe en clair
            $plainPassword = $user->getPassword();

            // On hash le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);

            // Mettre à jour le mot de passe dans l'objet utilisateur
            $user->setPassword($hashedPassword);

            // Enregistrer l'utilisateur dans la base de données
            $userRepository->add($user, true);

            $this->addFlash("create", "L'utilisateur a bien été créé.");
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository,  UserPasswordHasherInterface $passwordHasher): Response
    {

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'email de l'utilisateur
            $email = $user->getEmail();

            // Vérifier si un autre utilisateur avec le même email existe déjà
            $existingUser = $userRepository->findOneByEmailExceptUser($email, $user);
            if ($existingUser) {
                $errorMessage = 'Un autre utilisateur avec le même email existe déjà. Veuillez choisir un email différent.';
                return new Response($errorMessage, Response::HTTP_BAD_REQUEST);
            }

            // On récupère le mot de passe en clair
            $plainPassword = $request->request->get("user_edit")["password"]['first'];

            if (!empty($plainPassword)) { // Mettre à jour le mot de passe seulement si le champ n'est pas vide
                // On hash le mot de passe
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }

            // Mettre à jour l'utilisateur dans la base de données
            $userRepository->add($user, true);

            $this->addFlash("edit", "L'utilisateur a bien été édité.");
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete($id, Request $request, User $user, UserRepository $userRepository, ReviewRepository $reviewRepository, HeroRepository $heroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $allReviews = $reviewRepository->findByUser($id);

            foreach ($allReviews as $Review) {
                $reviewRepository->remove($Review);
            }

            $allheros = $heroRepository->findByUser($id);

            foreach ($allheros as $hero) {
                $heroRepository->remove($hero);
            }

            $userRepository->remove($user, true);
        }
        $this->addFlash("delete", "Votre Utilisateur a bien été effacé.");
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
