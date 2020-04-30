<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\{MensajeRepository, PedidosRepository,ComentarioRepository};

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
     * @Route("/page/admin/productosAdmin", name="productosAdmin")
     */
    public function productosAdmin()
    {
        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

     /**
     * @Route("/page/admin/comentAdmin", name="comentAdmin")
     */
    public function comentAdmin(ComentarioRepository $comentarioRepository)
    {
        return $this->render('adminPage/comentAdmin.html.twig', [
            'controller_name' => 'PageController',
            'comentarios' => $comentarioRepository->findAll(),
        ]);
    }


    /**
     * @Route("/page/admin/mensajes", name="mensajes")
     */
    public function mensajes()
    {
        return $this->render('adminPage/mensajes.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }
    /**
     * @Route("/page/admin/pedidos", name="pedidos")
     */
    public function pedidos()
    {
        return $this->render('adminPage/pedidos.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }
    /**
     * @Route("/page/admin/loginAdmin", name="loginAdmin")
     */
    public function loginAdmin()
    {
        return $this->render('adminPage/loginAdmin.html.twig', []);}

    /**
     * @Route("/page/admin/usuarios", name="usuarios")
     */
    public function usuarios()
    {
        return $this->render('adminPage/usuariosAdmin.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }
}
