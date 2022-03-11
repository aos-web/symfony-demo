<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType;
use App\Entity\Article;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class FormController extends AbstractController
{
    /**
     * New
     *
     * @Route("/form/new")
     * @param  Request $request
     * @param  ManagerRegistry $doctrine
     * @return Response
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $article = new Article();
        $article->setTitle('Hello World');
        $article->setContent('Un très court article.');
        $article->setAuthor('Zozor');
        $article->setDate(new DateTime());

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('default/new.html.twig', array(
            'articleForm' => $form->createView(),
        ));
    }

    /**
     * Edit
     *
     * @Route("/form/edit/{id<\d+>}")
     * @param  Request $request
     * @param  int $id
     * @param  ManagerRegistry $doctrine
     * @return Response
     */
    public function edit(Request $request, int $id, ManagerRegistry $doctrine): Response
    {
        $article = $doctrine->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Va effectuer la quête UPDATE en base de données
            $doctrine->getManager()->flush();
        }

        return $this->render('default/new.html.twig', array(
            'articleForm' => $form->createView(),
        ));
    }

    /**
     * Delete
     *
     * @Route("/form/delete/{id<\d+>}", methods={"POST"})
     * @param  Request $request
     * @param  int $id
     * @param  ManagerRegistry $doctrine
     * @return RedirectResponse
     */
    public function delete(Request $request, int $id, ManagerRegistry $doctrine): RedirectResponse
    {
        $article = $doctrine->getRepository(Article::class)->find($id);

        $entityManager = $doctrine->getManager();

        $entityManager->remove($article);
        $entityManager->flush();

        // Redirige la page
        return $this->redirectToRoute('admin_article_index');
    }
}
