<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{Mensaje,Comentario, Usuario, Producto};
use Symfony\Component\HttpFoundation\Request;
use App\Form\{MensajeType, ComentarioType, UsuarioType};
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="index" )
     */
    public function index(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);

            if ($usuarioBBDD){
             if ($usuarioBBDD->getContrasenya()==$password) {
                 
                  $usuarioIniciado=$this->getDoctrine()
                    ->getRepository(Usuario::Class)
                    ->findBy(
                        ['email' => $user], 
                        ['id' => 'ASC']
                      );
                      foreach ($usuarioIniciado as $usuario) {
                        $session->set('nombre_usuario', $usuario->getNombre());
                      }

                 $session->set('password', $password);
                    return $this->redirectToRoute('index', [
                         "user" => $user1,
                        
                ]);
            }
}
 else{
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'index',
            'jumbotron' => 'no',
            "user" => "",
            "user" => $user1,    
        ]);
 }
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        if ($usuarioBBDD){
            if ($usuarioBBDD->getContrasenya()==$password) {
                
                 $usuarioIniciado=$this->getDoctrine()
                   ->getRepository(Usuario::Class)
                   ->findBy(
                       ['email' => $user], 
                       ['id' => 'ASC']
                     );
                     foreach ($usuarioIniciado as $usuario) {
                       $session->set('nombre_usuario', $usuario->getNombre());
                     }

                $session->set('password', $password);
                   return $this->redirectToRoute('index', [
                        "user" => $user1,
                       
               ]);
           }
}
 else{
        return $this->render('page/productos.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'productos',
            'jumbotron' => 'si',
            'user' => "",
            "user" => $user1, 
        ]);
 }
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        if ($usuarioBBDD){
            if ($usuarioBBDD->getContrasenya()==$password) {
                
                 $usuarioIniciado=$this->getDoctrine()
                   ->getRepository(Usuario::Class)
                   ->findBy(
                       ['email' => $user], 
                       ['id' => 'ASC']
                     );
                     foreach ($usuarioIniciado as $usuario) {
                       $session->set('nombre_usuario', $usuario->getNombre());
                     }

                $session->set('password', $password);
                   return $this->redirectToRoute('index', [
                        "user" => $user1,
                       
               ]);
           }
}
 else{
        return $this->render('page/servicios.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'servicios',
            'jumbotron' => 'si',
            "user" => "",
            "user" => $user1, 
            ]);
        }
        }
    /**
     * @Route("/detalleprodc", name="detalleprod")
     */
    public function detalleprod(Request $request, SessionInterface $session)
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
            
            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
            $password= $password= $request->request->get("password");
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
            if ($usuarioBBDD){
                if ($usuarioBBDD->getContrasenya()==$password) {
                    
                     $usuarioIniciado=$this->getDoctrine()
                       ->getRepository(Usuario::Class)
                       ->findBy(
                           ['email' => $user], 
                           ['id' => 'ASC']
                         );
                         foreach ($usuarioIniciado as $usuario) {
                           $session->set('nombre_usuario', $usuario->getNombre());
                         }
   
                    $session->set('password', $password);
                       return $this->redirectToRoute('index', [
                            "user" => $user1,
                           
                   ]);
               }
   }
            else{
        return $this->render('page/detalleProduct.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'detalle',
            'form' => $form->CreateView(),
            'jumbotron' => 'no',
            "user" => "",
            "user" => $user1, 
        ]);
            }
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(Request $request, SessionInterface $session)
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

            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
            $password= $password= $request->request->get("password");
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
            if ($usuarioBBDD){
                if ($usuarioBBDD->getContrasenya()==$password) {
                    
                     $usuarioIniciado=$this->getDoctrine()
                       ->getRepository(Usuario::Class)
                       ->findBy(
                           ['email' => $user], 
                           ['id' => 'ASC']
                         );
                         foreach ($usuarioIniciado as $usuario) {
                           $session->set('nombre_usuario', $usuario->getNombre());
                         }
   
                    $session->set('password', $password);
                       return $this->redirectToRoute('index', [
                            "user" => $user1,
                           
                   ]);
               }
   }
    else{
        return $this->render('page/contacto.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'contacto',
            'form' => $form->CreateView(),
            'jumbotron' => 'si',
            "user" => "",
            "user" => $user1, 
        ]);
    }
    }
    /**
     * @Route("/carrito", name="carrito")
     */
    public function carrito(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        if ($usuarioBBDD){
            if ($usuarioBBDD->getContrasenya()==$password) {
                
                 $usuarioIniciado=$this->getDoctrine()
                   ->getRepository(Usuario::Class)
                   ->findBy(
                       ['email' => $user], 
                       ['id' => 'ASC']
                     );
                     foreach ($usuarioIniciado as $usuario) {
                       $session->set('nombre_usuario', $usuario->getNombre());
                     }

                $session->set('password', $password);
                   return $this->redirectToRoute('index', [
                        "user" => $user1,
                       
               ]);
           }
}
else{
        return $this->render('page/carrito.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'carrito',
            'jumbotron' => 'no',
            "user" => "",
            "user" => $user1, 
        ]);
}
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, SessionInterface $session)
    {
        $contactoBBDD=$this->getDoctrine()->getRepository(Usuario::Class)->findAll();
        $contactoTo=new Usuario();
        $form=$this->CreateForm(UsuarioType::Class, $contactoTo);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFechaRegistro(new \DateTime('now'));
            $entityManager->persist($contactoTo);
            $entityManager->flush();}

            $user1 = $session->get('nombre_usuario');
            $user= $request->request->get("user");
            $password= $password= $request->request->get("password");
            $usuarioBBDD=$this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['email' => $user]);
            if ($usuarioBBDD){
                if ($usuarioBBDD->getContrasenya()==$password) {
                    
                     $usuarioIniciado=$this->getDoctrine()
                       ->getRepository(Usuario::Class)
                       ->findBy(
                           ['email' => $user], 
                           ['id' => 'ASC']
                         );
                         foreach ($usuarioIniciado as $usuario) {
                           $session->set('nombre_usuario', $usuario->getNombre());
                         }
   
                    $session->set('password', $password);
                       return $this->redirectToRoute('index', [
                            "user" => $user1,
                           
                   ]);
               }
   }

        return $this->render('page/registro.html.twig', [
            'page' => 'carrito',
            'jumbotron' => 'no',
            'form' => $form->CreateView(),
            "user" => "",
            "user" => $user1, 

        ]);}

    /**
     * @Route("/pruebainicio", name="pruebainicio")
     */
    public function pruebainicio(Request $request, SessionInterface $session)
    {
        $user1 = $session->get('nombre_usuario');
        $user= $request->request->get("user");
        $password= $password= $request->request->get("password");
        $usuarioBBDD=$this->getDoctrine()
        ->getRepository(Usuario::class)
        ->findOneBy(['email' => $user]);
        if ($usuarioBBDD){
            if ($usuarioBBDD->getContrasenya()==$password) {
                
                 $usuarioIniciado=$this->getDoctrine()
                   ->getRepository(Usuario::Class)
                   ->findBy(
                       ['email' => $user], 
                       ['id' => 'ASC']
                     );
                     foreach ($usuarioIniciado as $usuario) {
                       $session->set('nombre_usuario', $usuario->getNombre());
                     }

                $session->set('password', $password);
                   return $this->redirectToRoute('index', [
                        "user" => $user1,
                       
               ]);
           }
}
else{
        return $this->render('page/pruebainicio.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'carrito',
            'jumbotron' => 'no',
            "user" => "",
            "user" => $user1, 
        ]);
    }
}
       /**
     * @Route("/logOut", name="logOut")
     */
    public function logOut(Request $request, SessionInterface $session)
    {
        $session->clear();
        $session->invalidate();
                return $this->redirectToRoute('index');

    }
}
