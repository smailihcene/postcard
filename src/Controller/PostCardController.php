<?php

namespace App\Controller;

use App\Entity\PostCard;
use App\Form\PostCardType;
use App\Repository\PostCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post/card')]
class PostCardController extends AbstractController
{
    #[Route('/', name: 'app_post_card_index', methods: ['GET'])]
    public function index(PostCardRepository $postCardRepository): Response
    {
        return $this->render('post_card/index.html.twig', [
            'post_cards' => $postCardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_card_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostCardRepository $postCardRepository): Response
    {
        $postCard = new PostCard();
        $form = $this->createForm(PostCardType::class, $postCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postCardRepository->save($postCard, true);

            return $this->redirectToRoute('app_post_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_card/new.html.twig', [
            'post_card' => $postCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_card_show', methods: ['GET'])]
    public function show(PostCard $postCard): Response
    {
        return $this->render('post_card/show.html.twig', [
            'post_card' => $postCard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_card_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostCard $postCard, PostCardRepository $postCardRepository): Response
    {
        $form = $this->createForm(PostCardType::class, $postCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postCardRepository->save($postCard, true);

            return $this->redirectToRoute('app_post_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_card/edit.html.twig', [
            'post_card' => $postCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_card_delete', methods: ['POST'])]
    public function delete(Request $request, PostCard $postCard, PostCardRepository $postCardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postCard->getId(), $request->request->get('_token'))) {
            $postCardRepository->remove($postCard, true);
        }

        return $this->redirectToRoute('app_post_card_index', [], Response::HTTP_SEE_OTHER);
    }
}
