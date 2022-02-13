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
            'articles' => $this->articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/article/{id}-{slug}", name="show_article", requirements={"id"="\d+"})
     */
    public function showArticle(ArticleRepository $articleRepository, $slug, $id): Response
    {
        $article = $articleRepository->find($id);
        if($article->getSlug() !== $slug) {
        return $this->redirectToRoute('show_article', [
            'id' => $id,
            'slug' => $article->getSlug()
        ]);
        }
        return $this->render('front/show_article.html.twig', [
            'article' => $article,
        ]);
    }
}
