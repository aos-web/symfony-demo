<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Controller used to manage blog contents in the backend.
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/admin/post/home", name="admin-post-home")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function home(): Response
    {
        return $this->render('admin/blog/home.html.twig');
    }
}
