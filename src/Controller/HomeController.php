<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     *
     * @Route("/home", name="accueil")
     */
    public function home(MessageGenerator $messageGenerator): Response
    {
        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);

        return $this->render('hello.html.twig', ['name' => $message]);
    }

    /**
     * Page d'accès à un article
     *
     * @Route("/article/{articleId}", name="show-article")
     */
    public function show($articleId)
    {
        return new Response("Voici le contenu de l'article avec l'ID $articleId");
    }
}
