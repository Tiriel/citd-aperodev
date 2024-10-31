<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/new', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function index(Request $request, CommentRepository $repository, MovieRepository $movieRepository): Response
    {
        $comment = new Comment();
        $options = [];
        if ($movieId = $request->query->get('movie_id', null)) {
            $options['movie'] = $movieRepository->find($movieId);
        }
        $form = $this->createForm(CommentType::class, $comment, $options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPostedAt(new \DateTimeImmutable());
            $repository->save($comment, true);

            return $this->redirectToRoute('app_movie_show', ['id' => $comment->getMovie()->getId()]);
        }

        return $this->render('comment/index.html.twig', [
            'form' => $form,
        ]);
    }
}
