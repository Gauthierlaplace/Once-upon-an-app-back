<?php

namespace App\Controller;

use App\Entity\Npc;
use App\Form\NpcType;
use App\Repository\AnswerRepository;
use App\Repository\DialogueRepository;
use App\Repository\NpcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/npc")
 */
class NpcController extends AbstractController
{
    /**
     * @Route("/", name="app_npc_index", methods={"GET"})
     */
    public function index(NpcRepository $npcRepository): Response
    {
        return $this->render('npc/index.html.twig', [
            'npcs' => $npcRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_npc_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NpcRepository $npcRepository): Response
    {
        $npc = new Npc();
        $form = $this->createForm(NpcType::class, $npc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $npcRepository->add($npc, true);

            return $this->redirectToRoute('app_npc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('npc/new.html.twig', [
            'npc' => $npc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_npc_show", methods={"GET"})
     */
    public function show(Npc $npc): Response
    {
        $items = $npc->getItem()->toArray();

        return $this->render('npc/show.html.twig', [
            'npc' => $npc,
            'items' => $items
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_npc_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Npc $npc, NpcRepository $npcRepository): Response
    {
        $form = $this->createForm(NpcType::class, $npc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $npcRepository->add($npc, true);

            return $this->redirectToRoute('app_npc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('npc/edit.html.twig', [
            'npc' => $npc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_npc_delete", methods={"POST"})
     */
    public function delete($id, Request $request, Npc $npc, NpcRepository $npcRepository, DialogueRepository $dialogueRepository, AnswerRepository $answerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$npc->getId(), $request->request->get('_token'))) {

            $allDialogues = $dialogueRepository->findByNpc($id);
    
            foreach ($allDialogues as $dialogue) {
                $dialogueId = $dialogue->getId();
                $allAnswers = $answerRepository->findByDialogue($dialogueId);
                foreach ($allAnswers as $answer) {
                    $answerRepository->remove($answer);
                }
                $dialogueRepository->remove($dialogue);
            }


            $npcRepository->remove($npc, true);
        }

        return $this->redirectToRoute('app_npc_index', [], Response::HTTP_SEE_OTHER);
    }
}
