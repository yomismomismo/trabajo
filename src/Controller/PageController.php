<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{Mensaje,Comentario, Usuario, Producto};
use Symfony\Component\HttpFoundation\Request;
use App\Form\{MensajeType, ComentarioType, UsuarioType};

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
    public function detalleprod(Request $request)
    {
        $contactoTo=new Comentario();
        $form=$this->CreateForm(ComentarioType::Class, $contactoTo);

        $filtroUsuario=$this->getDoctrine()

        ->getRepository(Usuario::Class)
        ->findBy(
            ['id' => "1"], 
            ['id' => 'ASC']
          );

          $filtroProducto=$this->getDoctrine()

          ->getRepository(Producto::Class)
          ->findBy(
              ['id' => "1"], 
              ['id' => 'ASC']
            );




        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFecha(new \DateTime('now'));
            foreach ($filtroUsuario as $userid) {
                $contactoTo->setIdUsuario($userid);
              }
              foreach ($filtroProducto as $productoid) {
                $contactoTo->setIdProducto($productoid);
              }
            // $contactoTo->setIdProducto('1');
            $entityManager->persist($contactoTo);
            $entityManager->flush();}
            

        return $this->render('page/detalleProduct.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'detalle',
            'form' => $form->CreateView(),
            'jumbotron' => 'no',
        ]);
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(Request $request)
    {
        $contactoBBDD=$this->getDoctrine()->getRepository(Mensaje::Class)->findAll();
        $contactoTo=new Mensaje();
        $form=$this->CreateForm(MensajeType::Class, $contactoTo);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFecha(new \DateTime('now'));
            $entityManager->persist($contactoTo);
            $entityManager->flush();}

        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'contacto',
            'form' => $form->CreateView(),
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
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $contactoBBDD=$this->getDoctrine()->getRepository(Usuario::Class)->findAll();
        $contactoTo=new Usuario();
        $form=$this->CreateForm(UsuarioType::Class, $contactoTo);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFechaRegistro(new \DateTime('now'));
            $entityManager->persist($contactoTo);
            $entityManager->flush();}

        return $this->render('page/registro.html.twig', [
            'page' => 'carrito',
            'jumbotron' => 'no',
            'form' => $form->CreateView(),

        ]);}

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
