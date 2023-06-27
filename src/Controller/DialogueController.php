<?php

namespace App\Controller;

use App\Entity\Dialogue;
use App\Form\DialogueType;
use App\Repository\AnswerRepository;
use App\Repository\DialogueRepository;
use App\Services\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dialogue")
 */
class DialogueController extends AbstractController
{
    /**
     * @Route("/", name="app_dialogue_index", methods={"GET"})
     */
    public function index(DialogueRepository $dialogueRepository, PaginatorService $paginatorService): Response
    {
        $dialoguesToPaginate = $dialogueRepository->findBy([],['npc' => 'ASC']);
        $dialoguesPaginated = $paginatorService->paginator($dialoguesToPaginate, 8);
        return $this->render('dialogue/index.html.twig', [
            'dialogues' => $dialoguesPaginated,
        ]);
    }

    /**
     * @Route("/new", name="app_dialogue_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DialogueRepository $dialogueRepository): Response
    {
        $dialogue = new Dialogue();
        $form = $this->createForm(DialogueType::class, $dialogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dialogueRepository->add($dialogue, true);

            $this->addFlash("create", "Le dialogue a bien été créé.");
            return $this->redirectToRoute('app_dialogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dialogue/new.html.twig', [
            'dialogue' => $dialogue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dialogue_show", methods={"GET"})
     */
    public function show(Dialogue $dialogue): Response
    {
        return $this->render('dialogue/show.html.twig', [
            'dialogue' => $dialogue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dialogue_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Dialogue $dialogue, DialogueRepository $dialogueRepository): Response
    {
        $form = $this->createForm(DialogueType::class, $dialogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dialogueRepository->add($dialogue, true);

            $this->addFlash("edit", "Le dialogue a bien été édité.");
            return $this->redirectToRoute('app_dialogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dialogue/edit.html.twig', [
            'dialogue' => $dialogue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dialogue_delete", methods={"POST"})
     */
    public function delete($id, Request $request, Dialogue $dialogue, DialogueRepository $dialogueRepository, AnswerRepository $answerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dialogue->getId(), $request->request->get('_token'))) {
            
            $allAnswers = $answerRepository->findByDialogue($id);
    
            foreach ($allAnswers as $answer) {
                $answerRepository->remove($answer);
            }


            $dialogueRepository->remove($dialogue, true);
        }
        $this->addFlash("delete", "Le dialogue a bien été effacé.");
        return $this->redirectToRoute('app_dialogue_index', [], Response::HTTP_SEE_OTHER);
    }
}
