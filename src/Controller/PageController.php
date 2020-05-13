<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\{Mensaje,Comentario, Usuario, Producto, Productoxpedidos, Pedidos};
use Symfony\Component\HttpFoundation\Request;
use App\Form\{MensajeType, ComentarioType, UsuarioType, ProductoxpedidoType, PedidosType};
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="index" )
     */
    public function index(Request $request, SessionInterface $session)
    {
      $user1 = $session->get('nombre_usuario');
      if ($user1) {


        $usuarioIniciado=$this->getDoctrine()
              ->getRepository(Usuario::Class)
              ->findBy(
                    ['nombre' => $user1], 
                    ['id' => 'ASC']
                      );
          
        $iduser=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['id' => $idusuario]);
          
              
      //Acaba Filtro de usuario

      //Filtro Pedido 

        $pedidos=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['id_cliente' => $iduser->getId()]);
          
            
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(
                     ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                    }else {
                      $estado="";
                      $pedidos="";

                    }
                   
    if ( $estado && $pedidos) {

        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(
                     ['id' => $estado->getId()]);
            
        $idpedidoEstado=$estado->getId();

        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(
                     ['id_pedido' => $idpedidoEstado]);

        $idproductoRepe=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findOneBy(
                            ['id_pedido' => $idpedidoEstado]);  

        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(
                     ['id' => $idpedidoEstado], 
                     ['id' => 'ASC']
                    );}
              
        else{$idproducto="";
          $idproductoRepe="";}
      
      //Filtro producto 
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
            "filtroPedido" => $idproducto, 
        ]);
 }
    }

    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request, SessionInterface $session)
    {

      $user1 = $session->get('nombre_usuario');
      if ($user1) {


        $usuarioIniciado=$this->getDoctrine()
              ->getRepository(Usuario::Class)
              ->findBy(
                    ['nombre' => $user1], 
                    ['id' => 'ASC']
                      );
          
        $iduser=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['id' => $idusuario]);
          
              
      //Acaba Filtro de usuario

      //Filtro Pedido 

        $pedidos=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['id_cliente' => $iduser->getId()]);
          
            
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(
                     ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                    }else {
                      $estado="";
                      $pedidos="";

                    }
                   
    if ( $estado && $pedidos) {

        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(
                     ['id' => $estado->getId()]);
            
        $idpedidoEstado=$estado->getId();

        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(
                     ['id_pedido' => $idpedidoEstado]);

        $idproductoRepe=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findOneBy(
                            ['id_pedido' => $idpedidoEstado]);  

        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(
                     ['id' => $idpedidoEstado], 
                     ['id' => 'ASC']
                    );}
              
        else{$idproducto="";
          $idproductoRepe="";}
      
      //Filtro producto 



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
            "filtroPedido" => $idproducto,
        ]);
 }
    }

    /**
     * @Route("/servicios", name="servicios")
     */
    public function servicios(Request $request, SessionInterface $session)
    {
      $user1 = $session->get('nombre_usuario');
      if ($user1) {


        $usuarioIniciado=$this->getDoctrine()
              ->getRepository(Usuario::Class)
              ->findBy(
                    ['nombre' => $user1], 
                    ['id' => 'ASC']
                      );
          
        $iduser=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['id' => $idusuario]);
          
              
      //Acaba Filtro de usuario

      //Filtro Pedido 

        $pedidos=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['id_cliente' => $iduser->getId()]);
          
            
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(
                     ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                    }else {
                      $estado="";
                      $pedidos="";

                    }
                   
    if ( $estado && $pedidos) {

        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(
                     ['id' => $estado->getId()]);
            
        $idpedidoEstado=$estado->getId();

        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(
                     ['id_pedido' => $idpedidoEstado]);

        $idproductoRepe=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findOneBy(
                            ['id_pedido' => $idpedidoEstado]);  

        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(
                     ['id' => $idpedidoEstado], 
                     ['id' => 'ASC']
                    );}
              
        else{$idproducto="";
          $idproductoRepe="";}
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
            "filtroPedido" => $idproducto,
            ]);
        }
        }
    /**
     * @Route("/detalleprodc/{id}", name="detalleprod")
     */
    public function detalleprod(Request $request, $id, SessionInterface $session)
    {
        //Mantenemos la sesión del usuario
          $user1 = $session->get('nombre_usuario');

        //Filtramos los comentarios de cada producto
        $comentarios=$this->getDoctrine()
        ->getRepository(Comentario::Class)
        ->findBy(
              ['id_producto' => $id, ], 
              ['id' => 'ASC']
                );

        //Fin de filtro de los comentarios

        //Filtro Usuario  
if ($user1) {


          $usuarioIniciado=$this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                      ['nombre' => $user1], 
                      ['id' => 'ASC']
                        );
            
          $iduser=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['nombre' => $user1]);

          $idusuario= $iduser->getId();

          $idusario=$this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['id' => $idusuario]);
            
                
        //Acaba Filtro de usuario

        //Filtro Pedido 

          $pedidos=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findOneBy(['id_cliente' => $iduser->getId()]);
            
              
          $estado=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findOneBy(
                       ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                      }else {
                        $estado="";
                        $pedidos="";

                      }
                     
      if ( $estado && $pedidos) {

          $idestado=$this->getDoctrine()
                ->getRepository(Pedidos::class)
                ->findBy(
                       ['id' => $estado->getId()]);
              
          $idpedidoEstado=$estado->getId();

          $idproducto=$this->getDoctrine()
                ->getRepository(Productoxpedidos::class)
                ->findBy(
                       ['id_pedido' => $idpedidoEstado]);

          $idproductoRepe=$this->getDoctrine()
                ->getRepository(Productoxpedidos::class)
                ->findOneBy(
                              ['id_pedido' => $idpedidoEstado, "id_producto" => $id]);  

          $filtroPedido=$this->getDoctrine()
                ->getRepository(Pedidos::Class)
                ->findBy(
                       ['id' => $idpedidoEstado], 
                       ['id' => 'ASC']
                      );}
                
          else{$idproducto="";
            $idproductoRepe="";}
        
        //Filtro producto 

          $filtroProducto=$this->getDoctrine()
                ->getRepository(Producto::Class)
                ->findBy(
                       ['id' => $id], 
                       ['id' => 'ASC']
                      );

          $PedidoCreadoAhora="";

        //Acaba Filtro de producto

       //Envio de datos a la tabla productoxpedidos si hay un pedido incompleto

          $contactoTopedido=new Productoxpedidos();
          $actualizaCantidad=new Productoxpedidos();
          $formpedido=$this->CreateForm(ProductoxpedidoType::Class, $contactoTopedido);
          $formpedido->handleRequest($request);
          $formcantidad=$this->CreateForm(ProductoxpedidoType::Class, $actualizaCantidad);
          $formcantidad->handleRequest($request);
            
      if ($pedidos  && $estado) {
            
        if ($idusario->getId() == $pedidos->getIdCliente()->getId() && $estado){
                
            if($formpedido->isSubmitted() && $formpedido->isValid()){

                  $entityManager1=$this->getDoctrine()->getManager();
                    
                  foreach ($filtroProducto as $productoid) {
                     $contactoTopedido->setIdProducto($productoid);
                  }

                  foreach ($idestado as $pedidoid) {
                     $contactoTopedido->setIdPedido($pedidoid);
                  }
                  // && $mierda->getIdPedido()->getId() != $estado-getId()

                if ($idproductoRepe) {
                
                  if ($idproductoRepe->getIdProducto()->getId() != $id) {
                    $entityManager1->persist($contactoTopedido);
                    $entityManager1->flush(); 
                    return $this->redirectToRoute('detalleprod', [
                      "id" => $id,
                     
             ]);

                  }  
                  else{ 
                    echo("Hola");
                    foreach ($filtroProducto as $productoid) {
                      $actualizaCantidad->setIdProducto($productoid);
                   }
 
                   foreach ($idestado as $pedidoid) {
                      $actualizaCantidad->setIdPedido($pedidoid);
                   }  
                   $actualizaCantidad->setCantidad($actualizaCantidad->getCantidad() + $idproductoRepe->getCantidad());
                   $entityManager1->remove($idproductoRepe);
                    $entityManager1->persist($actualizaCantidad);
                  $entityManager1->flush();};
                  return $this->redirectToRoute('detalleprod', [
                    "id" => $id]);
            }
         
          else{

                    $entityManager1->persist($contactoTopedido);
                    $entityManager1->flush(); 
                    return $this->redirectToRoute('detalleprod', [
                      "id" => $id]);
          }
          } }
        }

        //Finaliza el envio de datos a la tabla productoxpedido

        //Creamos el pedido incompleto al pulsar el botón de añadir producto

                  else{
                
                    $contactoTopedidos=new Pedidos();
                    $formpedidos=$this->CreateForm(PedidosType::Class, $contactoTopedidos);
                    $formpedidos->handleRequest($request);
                    if($formpedido->isSubmitted() && $formpedido->isValid()){
                      echo("Hola");   
                        $entityManager1=$this->getDoctrine()->getManager();
                        $contactoTopedidos->setIdCliente($idusario);
                        $contactoTopedidos->setNombreCliente($iduser->getNombre());
                        $contactoTopedidos->setTelefono($iduser->getTelefono());
                        $contactoTopedidos->setProvincia($iduser->getProvincia());
                        $contactoTopedidos->setDireccion($iduser->getDireccion());
                        $contactoTopedidos->setFechaPedido(new \DateTime('now'));
                        $contactoTopedidos->setEstado("incompleto");
                        $pedidos=$this->getDoctrine()
                        ->getRepository(Pedidos::class)
                        ->findOneBy(['id_cliente' => $iduser->getId()]);
                        $PedidoCreadoAhora="True";
                        $entityManager1->persist($contactoTopedidos);
                        $entityManager1->flush();
                        // return $this->redirectToRoute('detalleprod', [
                        //   "id" => $id]);
                      }

        //Finaliza el crear el pedido

        //Creamos los productos del pedido creado ahora mismo
                }

                
            //     $cantidadActualizada= $idproductoRepe->getCantidad() + 2;    
            // echo($cantidadActualizada);
      
                if ($PedidoCreadoAhora) {
                 echo("Hola");
                $estado=$this->getDoctrine()
                  ->getRepository(Pedidos::class)
                  ->findOneBy(['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);

                $idestado=$this->getDoctrine()
                  ->getRepository(Pedidos::class)
                  ->findBy(['id' => $estado->getId()]);
                
                $idpedidoEstado=$estado->getId();

                $filtroPedido=$this->getDoctrine()
                ->getRepository(Pedidos::Class)
                ->findBy(
                    ['id' => $idpedidoEstado], 
                    ['id' => 'ASC']
                  ); 

                foreach ($filtroProducto as $productoid) {
                  $contactoTopedido->setIdProducto($productoid);
                }
                foreach ($idestado as $pedidoid) {
                  $contactoTopedido->setIdPedido($pedidoid);
                }

                $entityManager1->persist($contactoTopedido);
                $entityManager1->flush();
                return $this->redirectToRoute('detalleprod', [
                  "id" => $id,
                 
         ]);
        
       }

        //Finalizado crear productos en el pedido

        //Filtro del usuario

                // $filtroUsuario=$this->getDoctrine()
                // ->getRepository(Usuario::Class)
                // ->findBy(
                //     ['id' => "1"], 
                //     ['id' => 'ASC']
                //   );

        //Acaba filtro del usuario



         //Formulario Comentario   
        $contactoTo=new Comentario();
        $form=$this->CreateForm(ComentarioType::Class, $contactoTo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $contactoTo->setFecha(new \DateTime('now'));

                $contactoTo->setIdUsuario($iduser);
           
              foreach ($filtroProducto as $productoid) {
                $contactoTo->setIdProducto($productoid);
              }
            $entityManager->persist($contactoTo);
            $entityManager->flush();
            return $this->redirectToRoute('detalleprod', [
              "id" => $id,
             
     ]);}
            //Acaba formulario del comentario

          //Inicio de sesión de usuario
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
      //Fin inicio de sesión de usuario
            else{
        return $this->render('page/detalleProduct.html.twig', [
            'controller_name' => 'PageController',
            'page' => 'detalle',
            'form' => $form->CreateView(),
            'form1' => $formpedido->CreateView(),
            'jumbotron' => 'no',
            "user" => "",
            "user" => $user1, 
            "producto" => $filtroProducto,
            "puntuacion1" => "3",
            "filtroPedido" => $idproducto,
            "Comentario" => $comentarios,


        ]);
            }
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(Request $request, SessionInterface $session)
    {
      $user1 = $session->get('nombre_usuario');
      if ($user1) {


        $usuarioIniciado=$this->getDoctrine()
              ->getRepository(Usuario::Class)
              ->findBy(
                    ['nombre' => $user1], 
                    ['id' => 'ASC']
                      );
          
        $iduser=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['nombre' => $user1]);

        $idusuario= $iduser->getId();

        $idusario=$this->getDoctrine()
              ->getRepository(Usuario::class)
              ->findOneBy(['id' => $idusuario]);
          
              
      //Acaba Filtro de usuario

      //Filtro Pedido 

        $pedidos=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(['id_cliente' => $iduser->getId()]);
          
            
        $estado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findOneBy(
                     ['estado' => "incompleto", 'id_cliente' => $idusario->getId()]);
                    }else {
                      $estado="";
                      $pedidos="";

                    }
                   
    if ( $estado && $pedidos) {

        $idestado=$this->getDoctrine()
              ->getRepository(Pedidos::class)
              ->findBy(
                     ['id' => $estado->getId()]);
            
        $idpedidoEstado=$estado->getId();

        $idproducto=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findBy(
                     ['id_pedido' => $idpedidoEstado]);

        $idproductoRepe=$this->getDoctrine()
              ->getRepository(Productoxpedidos::class)
              ->findOneBy(
                            ['id_pedido' => $idpedidoEstado]);  

        $filtroPedido=$this->getDoctrine()
              ->getRepository(Pedidos::Class)
              ->findBy(
                     ['id' => $idpedidoEstado], 
                     ['id' => 'ASC']
                    );}
              
        else{$idproducto="";
          $idproductoRepe="";}
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
            "filtroPedido" => $idproducto,
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
