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
            'page' => 'index',
            'jumbotron' => 'no'
        ]);
        
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos()
    {
        return $this->render('page/productos.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'productos',
            'jumbotron' => 'si'
        ]);
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios()
    {
        return $this->render('page/servicios.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'servicios',
            'jumbotron' => 'si'
            ]);
        }
    /**
     * @Route("/detalleprodc", name="detalleprod")
     */
    public function detalleprod()
    {
        return $this->render('page/detalleProduct.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'detalle',
            'jumbotron' => 'no'
        ]);
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'contacto',
            'jumbotron' => 'si'
        ]);
    }
    /**
     * @Route("/carrito", name="carrito")
     */
    public function carrito()
    {
        return $this->render('page/carrito.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'carrito',
            'jumbotron' => 'no'
        ]);
    }

    /**
     * @Route("/pruebainicio", name="pruebainicio")
     */
    public function pruebainicio()
    {
        return $this->render('page/pruebainicio.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'carrito',
            'jumbotron' => 'no'
        ]);
    }
}
