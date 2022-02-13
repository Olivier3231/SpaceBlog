<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository =$articleRepository;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'article' => $this->articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/article/{id}-{slug}", name="show_article")
     */
    public function showArticle(Article $article): Response
    {
        return $this->render('front/show_article.html.twig', [
            'article' => $article,
        ]);
    }
}
