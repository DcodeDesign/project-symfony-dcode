<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesFormType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    private $_articlesRepository;
    private $_em;

    /**
     * AdminArticlesController constructor.
     * @param ArticlesRepository $Repository
     * @param EntityManagerInterface $em
     */
    public function __construct(ArticlesRepository $Repository, EntityManagerInterface $em)
    {
        $this->_articlesRepository = $Repository;
        $this->_em = $em;
    }

    /**
     * @Route("/admin/articles", name="admin.articles")
     */
    public function index(): Response
    {
        // $articles = $this->_articlesRepository->findAll();
        $articles = $this->_articlesRepository->allArticles();
        return $this->render('admin_articles/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * CREATE
     * @Route("/admin/article/create", name="admin.article.new")
     * @param Request $request
     */
    public function new(Request $request) {
        $Articles = new Articles();
        $form = $this->createForm(ArticlesFormType::class, $Articles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->_em->persist($Articles);
            $this->_em->flush();
            $this->addFlash('success', 'Article créé avec succès');
            return $this->redirectToRoute('admin.articles');
        }

        return $this->render('admin_articles/new.html.twig', [
            'articles' => $this->_articlesRepository,
            'form' => $form->createView()
        ]);
    }

    /** UPDATE
     * @Route("/admin/article/{id}", name="admin.article.edit", methods="GET|POST")
     * @param Articles $ArticlesEntity
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function edit(Articles $ArticlesEntity, Request $request, int $id) {
        $form = $this->createForm(ArticlesFormType::class, $ArticlesEntity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_em->flush();
            $this->addFlash('success', 'Articles modifié avec succès');
            return $this->redirectToRoute('admin.articles');
        }

        $article = $this->_articlesRepository->find($id);
        return $this->render('admin_articles/edit.html.twig', [
            'article' => $article ,
            'form' => $form->createView()
        ]);
    }

    /**
     * DELETE
     * @Route("/admin/article/{id}", name="admin.article.delete", methods="DELETE")
     * @param Articles $articles
     * @param Request $request
     * @return Response
     */
    public function delete(Articles $articles, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $articles->getId(), $request->get('_token'))){
            $this->_em->remove($articles);
            $this->addFlash('success', 'Article supprimé avec succès');
            $this->_em->flush();
        }
        return $this->redirectToRoute('admin.articles');
    }

}
