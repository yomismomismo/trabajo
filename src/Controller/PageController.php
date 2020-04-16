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
        return $this->render('page/index.html', [
            'controller_name' => 'PageController',
        ]);
        
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos()
    {
        return $this->render('page/productos.html', [
            'controller_name' => 'PageController',
        ]);
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios()
    {
        return $this->render('page/servicios.html', [
            'controller_name' => 'PageController',
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
        return $this->render('page/contacto.html', [
            'controller_name' => 'PageController',
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
