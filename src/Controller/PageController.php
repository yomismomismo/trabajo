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
<<<<<<< HEAD

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios()
    {
        return $this->render('page/servicios.html', [
=======
    /**
     * @Route("/detalleprodc", name="detalleprod")
     */
    public function detalleprod()
    {
        return $this->render('page/detalleProduct.html', [
>>>>>>> bed5e1ed840b29e32fb5320323e4145a951a8edd
            'controller_name' => 'PageController',
        ]);
    }
}
