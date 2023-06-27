<?php

namespace App\Controller;

use App\Entity\Race;
use App\Form\RaceType;
use App\Repository\AnswerRepository;
use App\Repository\DialogueRepository;
use App\Repository\NpcRepository;
use App\Repository\RaceRepository;
use App\Services\PaginatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/race")
 */
class RaceController extends AbstractController
{
    /**
     * @Route("/", name="app_race_index", methods={"GET"})
     */
    public function index(RaceRepository $raceRepository, PaginatorService $paginatorService): Response
    {
        $racesToPaginate = $raceRepository->findBy([],['name' => 'ASC']);
        $racesPaginated = $paginatorService->paginator($racesToPaginate, 10);
        return $this->render('race/index.html.twig', [
            'races' => $racesPaginated,
        ]);
    }

    /**
     * @Route("/new", name="app_race_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RaceRepository $raceRepository): Response
    {
        $race = new Race();
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raceRepository->add($race, true);

            $this->addFlash("create", "La race a bien été créée.");

            return $this->redirectToRoute('app_race_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('race/new.html.twig', [
            'race' => $race,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_race_show", methods={"GET"})
     */
    public function show(Race $race): Response
    {
        return $this->render('race/show.html.twig', [
            'race' => $race,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_race_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Race $race, RaceRepository $raceRepository): Response
    {
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raceRepository->add($race, true);

            $this->addFlash("edit", "La race a bien été éditée.");
            return $this->redirectToRoute('app_race_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('race/edit.html.twig', [
            'race' => $race,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_race_delete", methods={"POST"})
     */
    public function delete($id, Request $request, Race $race, RaceRepository $raceRepository, NpcRepository $npcRepository, DialogueRepository $dialogueRepository, AnswerRepository $answerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $race->getId(), $request->request->get('_token'))) {

            $allNpcs = $npcRepository->findByRace($id);

            foreach ($allNpcs as $npc) {
                $npcId = $npc->getId();
                $allDialogues = $dialogueRepository->findByNpc($npcId);

                foreach ($allDialogues as $dialogue) {
                    $dialogueId = $dialogue->getId();
                    $allAnswers = $answerRepository->findByDialogue($dialogueId);
                    foreach ($allAnswers as $answer) {
                        $answerRepository->remove($answer);
                    }
                    $dialogueRepository->remove($dialogue);
                }

                $npcRepository->remove($npc);
            }

            $raceRepository->remove($race, true);
        }
        $this->addFlash("delete", "La race a bien été effacée.");

        return $this->redirectToRoute('app_race_index', [], Response::HTTP_SEE_OTHER);
    }
}
