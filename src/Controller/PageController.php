<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'index'
        ]);
        
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos()
    {
        return $this->render('page/productos.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'productos'
        ]);
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios()
    {
        return $this->render('page/servicios.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'servicios'
            ]);
        }
    /**
     * @Route("/detalleprodc", name="detalleprod")
     */
    public function detalleprod()
    {
        return $this->render('page/detalleProduct.html', [
            'controller_name' => 'PageController',
            
        ]);
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'contacto'
        ]);
    }
    /**
     * @Route("/carrito", name="carrito")
     */
    public function carrito()
    {
        return $this->render('page/carrito.html', [
            'controller_name' => 'PageController',
        ]);
    }
}
