<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles")
     * @param ArticlesRepository $Repository
     * @return Response
     */
    public function index(ArticlesRepository $Repository): Response
    {
        $articles = $Repository->allArticles();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
