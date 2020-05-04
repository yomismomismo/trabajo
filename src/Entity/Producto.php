<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades_stock;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categoria;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades_vendidas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentario", mappedBy="id_producto")
     */
    private $comentariosRL;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;


    public function __construct()
    {
        $this->comentariosRL = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUnidadesStock(): ?int
    {
        return $this->unidades_stock;
    }

    public function setUnidadesStock(int $unidades_stock): self
    {
        $this->unidades_stock = $unidades_stock;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getUnidadesVendidas(): ?int
    {
        return $this->unidades_vendidas;
    }

    public function setUnidadesVendidas(int $unidades_vendidas): self
    {
        $this->unidades_vendidas = $unidades_vendidas;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentariosRL(): Collection
    {
        return $this->comentariosRL;
    }

    public function addComentariosRL(Comentario $comentariosRL): self
    {
        if (!$this->comentariosRL->contains($comentariosRL)) {
            $this->comentariosRL[] = $comentariosRL;
            $comentariosRL->setIdProducto($this);
        }

        return $this;
    }

    public function removeComentariosRL(Comentario $comentariosRL): self
    {
        if ($this->comentariosRL->contains($comentariosRL)) {
            $this->comentariosRL->removeElement($comentariosRL);
            // set the owning side to null (unless already changed)
            if ($comentariosRL->getIdProducto() === $this) {
                $comentariosRL->setIdProducto(null);
            }
        }

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }


}
