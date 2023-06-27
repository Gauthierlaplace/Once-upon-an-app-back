<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureEditType;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="app_picture_index", methods={"GET"})
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_picture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PictureRepository $pictureRepository): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form->get('base64')->getData();
            if ($uploadedFile) {

                //* Générer un nom de fichier unique
                // $filename = 'image_' . uniqid() . '.' . $uploadedFile->guessExtension();

                //* Générer un nom de fichier avec le nom du fichier
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = $originalFilename . '.' . $uploadedFile->guessExtension();

                 // Vérifier si un enregistrement avec le même nom existe déjà
            $existingImage = $pictureRepository->findOneBy(['name' => $filename]);
            if ($existingImage) {
                $errorMessage = 'Un fichier avec le même nom existe déjà. Veuillez choisir un nom de fichier différent.';
                return new Response($errorMessage, Response::HTTP_BAD_REQUEST);
            }

                // Déplacer le fichier vers le répertoire souhaité
                $uploadedFile->move($this->getParameter('kernel.project_dir') . '/public/images/', $filename);

                // Enregistrer les informations de l'image dans la base de données
                $picture->setName($filename);
                $picture->setPath('images/' . $filename);
            }

            $pictureRepository->add($picture, true);

            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_picture_show", methods={"GET"})
     */
    public function show(Picture $picture): Response
    {
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_picture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        $form = $this->createForm(PictureEditType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureRepository->add($picture, true);

            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_picture_delete", methods={"POST"})
     */
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $pictureRepository->remove($picture, true);
        }

        return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}
