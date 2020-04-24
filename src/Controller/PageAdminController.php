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

    /**
     * @Route("/page/productosAdmin", name="productosAdmin")
     */
    public function productosAdmin()
    {
        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

     /**
     * @Route("/page/comentAdmin", name="comentAdmin")
     */
    public function comentAdmin()
    {
        return $this->render('adminPage/comentAdmin.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }


}
