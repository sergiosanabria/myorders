<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductoRepository")
 */
class Producto extends BaseClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="controla_stock", type="boolean", nullable=true)
     */
    private $controlaStock;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_venta", nullable=true, type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precioVenta;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_costo", nullable=true, type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precioCosto;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductoCategoria", inversedBy="productos")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="producto_imagenes", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductoPrecio", mappedBy="producto", cascade={"persist"})
     */
    private $precios;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProductoStock", mappedBy="producto", cascade={"persist"})
     */
    private $stocks;

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->precios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->fechaActualizacion = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set controlaStock
     *
     * @param boolean $controlaStock
     *
     * @return Producto
     */
    public function setControlaStock($controlaStock)
    {
        $this->controlaStock = $controlaStock;

        return $this;
    }

    /**
     * Get controlaStock
     *
     * @return boolean
     */
    public function getControlaStock()
    {
        return $this->controlaStock;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return Producto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }


    /**
     * Set image
     *
     * @param string $image
     *
     * @return Producto
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Producto
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Producto
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Producto
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\ProductoCategoria $categoria
     *
     * @return Producto
     */
    public function setCategoria(\AppBundle\Entity\ProductoCategoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\ProductoCategoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add precio
     *
     * @param \AppBundle\Entity\ProductoPrecio $precio
     *
     * @return Producto
     */
    public function addPrecio(\AppBundle\Entity\ProductoPrecio $precio)
    {
        $this->precios[] = $precio;

        return $this;
    }

    /**
     * Remove precio
     *
     * @param \AppBundle\Entity\ProductoPrecio $precio
     */
    public function removePrecio(\AppBundle\Entity\ProductoPrecio $precio)
    {
        $this->precios->removeElement($precio);
    }

    /**
     * Get precios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrecios()
    {
        return $this->precios;
    }

    /**
     * Add stock
     *
     * @param \AppBundle\Entity\ProductoStock $stock
     *
     * @return Producto
     */
    public function addStock(\AppBundle\Entity\ProductoStock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \AppBundle\Entity\ProductoStock $stock
     */
    public function removeStock(\AppBundle\Entity\ProductoStock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Set creadoPor
     *
     * @param \AppBundle\Entity\User $creadoPor
     *
     * @return Producto
     */
    public function setCreadoPor(\AppBundle\Entity\User $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Set actualizadoPor
     *
     * @param \AppBundle\Entity\User $actualizadoPor
     *
     * @return Producto
     */
    public function setActualizadoPor(\AppBundle\Entity\User $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set precioVenta
     *
     * @param string $precioVenta
     *
     * @return Producto
     */
    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;

        return $this;
    }

    /**
     * Get precioVenta
     *
     * @return string
     */
    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }

    /**
     * Set precioCosto
     *
     * @param string $precioCosto
     *
     * @return Producto
     */
    public function setPrecioCosto($precioCosto)
    {
        $this->precioCosto = $precioCosto;

        return $this;
    }

    /**
     * Get precioCosto
     *
     * @return string
     */
    public function getPrecioCosto()
    {
        return $this->precioCosto;
    }
}
