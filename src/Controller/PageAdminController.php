<?php

namespace App\Controller;
use App\Entity\{Usuario, Pedidos, Producto, Productoxpedido, Comentario};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ProductoType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\{MensajeRepository, PedidosRepository, UsuarioRepository, ComentarioRepository, ProductoRepository};
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
class PageAdminController extends AbstractController
{
    /**
     * @Route("/page/admin", name="page_admin")
     */
    public function index()
    {
        $week = 10;

        return $this->render('adminPage/indexAdmin.html.twig', [
            'controller_name' => 'PageAdminController',
             ]);
    }

    /**
     * @Route("/page/admin/productosAdmin", name="productosAdmin")
     */
    public function productosAdmin(ProductoRepository $productoRepository, ComentarioRepository $comentarioRepository )
    {


        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
            'productos' => $productoRepository->findAll(),
            'comentario' => $comentarioRepository->findAll(),
            
        ]);
    }
    /**
     * @Route("/page/admin/deletecoment/{id}", name="deletecom")
     */
    public function deletecom(ProductoRepository $productoRepository, ComentarioRepository $comentarioRepository )
    {


        return $this->render('adminPage/prodcAdmin.html.twig', [
            'controller_name' => 'PageController',
            'productos' => $productoRepository->findAll(),
            'comentario' => $comentarioRepository->findAll(),
            
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
    public function mensajes(MensajeRepository $mensajeRepository)
    {
        return $this->render('adminPage/mensajes.html.twig', [
            'controller_name' => 'PageAdminController',
            'mensajes' => $mensajeRepository->findAll(),

        ]);
    }
    /**
     * @Route("/page/admin/pedidos", name="pedidos")
     */
    public function pedidos(PedidosRepository $pedidosRepository)
    {
        return $this->render('adminPage/pedidos.html.twig', [
            'controller_name' => 'PageAdminController',
            'pedidos' => $pedidosRepository->findAll(),
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
    public function usuarios(UsuarioRepository $usuarioRepository)
    {
        return $this->render('adminPage/usuariosAdmin.html.twig', [
            'controller_name' => 'PageAdminController',
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }
    /**
     * @Route("/page/admin/detalleUsuarios/{id}", name="detalleUsuarios", methods={"GET","POST"})
     */
    public function detalleUsuarios(Request $request, $id)
    {
        $equiposFiltro=$this->getDoctrine()
        ->getRepository(Usuario::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
        return $this->render('adminPage/detalleUsuario.html.twig', [
            'controller_name' => 'PageAdminController',
            'usuario' => $equiposFiltro,

        ]);
    }

    
    /**
     * @Route("/page/admin/detallepedido/{id}", name="detallepedido", methods={"GET","POST"})
     */
    public function detallepedido(Request $request, $id)
    {
        $pedidoFiltro=$this->getDoctrine()
        ->getRepository(Pedidos::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
          $productosFiltro=$this->getDoctrine()
          ->getRepository(Productoxpedido::Class)
          ->findBy(
              ['id_pedido' => $id], 
              ['id' => 'ASC']
            );
            foreach ($pedidoFiltro as $cliente) {
                $idcliente= $this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                    ['id' => $cliente->getIdCliente()], 
                    ['id' => 'ASC']
                  );
            }
        return $this->render('adminPage/invoice.html.twig', [
            'controller_name' => 'PageAdminController',
            'productos' => $productosFiltro,
            'idpedido'=> $id,
            'cliente' => $idcliente

        ]);
    }
    
    /**
     * @Route("/page/admin/detalleProducto/{id}", name="detalleProducto", methods={"GET","POST"})
     */
    public function detalleProducto(Request $request, $id, Producto $producto): Response
    {
        $equiposFiltro=$this->getDoctrine()
        ->getRepository(Producto::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );

          $form = $this->createForm(ProductoType::class, $producto);
          $form->handleRequest($request);
  
      if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detalleProducto', array('id' => $id));
        }
          
        return $this->render('adminPage/detalleProducto.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
            'controller_name' => 'PageAdminController',
            'producto' => $equiposFiltro,

        ]);
    }
    /**
     * @Route("/page/admin/pdf/{id}", name="pdf", methods={"GET","POST"})
     */
    public function pdf(Request $request,$id)
    {
        $pedidoFiltro=$this->getDoctrine()
        ->getRepository(Pedidos::Class)
        ->findBy(
            ['id' => $id], 
            ['id' => 'ASC']
          );
          $productosFiltro=$this->getDoctrine()
          ->getRepository(Productoxpedido::Class)
          ->findBy(
              ['id_pedido' => $id], 
              ['id' => 'ASC']
            );
            foreach ($pedidoFiltro as $cliente) {
                $idcliente= $this->getDoctrine()
                ->getRepository(Usuario::Class)
                ->findBy(
                    ['id' => $cliente->getIdCliente()], 
                    ['id' => 'ASC']
                  );
            }
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('adminPage/factura.html.twig', [
            'title' => "Welcome to our PDF Test",
            'pedido' => $pedidoFiltro,
            'idpedido'=> $id,
            'productos' => $productosFiltro,
            'cliente' => $idcliente
        ]);
        $html = preg_replace("/>s+</", "><", $html);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }
}
