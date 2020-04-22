<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageAdminController extends AbstractController
{
    /**
     * @Route("/page/admin", name="page_admin")
     */
    public function index()
    {
        return $this->render('adminPage/indexAdmin.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }
}
