<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/page", name="page")
     */
    public function index()
    {
        return $this->render('page/productos.html', [
            'controller_name' => 'PageController',
        ]);
    }
}
