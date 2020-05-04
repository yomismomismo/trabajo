<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoxpedidoRepository")
 */
class Productoxpedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Producto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_producto;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pedidos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_pedido;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProducto(): ?Producto
    {
        return $this->id_producto;
    }

    public function setIdProducto(Producto $id_producto): self
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    public function getIdPedido(): ?Pedidos
    {
        return $this->id_pedido;
    }

    public function setIdPedido(Pedidos $id_pedido): self
    {
        $this->id_pedido = $id_pedido;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
