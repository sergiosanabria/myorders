<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 */
class Persona extends BaseClass
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
     * @ORM\Column(name="nombres", type="string", length=255)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="datetime", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoDoc", type="string", length=6)
     */
    private $tipoDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=20, nullable=true)
     */
    private $documento;


    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaDireccion", mappedBy="persona", cascade={"persist"})
     */
    private $direcciones;


    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaContacto", mappedBy="persona", cascade={"persist"})
     */
    private $contactos;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="persona")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Cliente", mappedBy="persona")
     */
    private $cliente;

    public function __toString()
    {
        return $this->nombres." ".$this->apellidos;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Persona
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set tipoDoc
     *
     * @param string $tipoDoc
     *
     * @return Persona
     */
    public function setTipoDoc($tipoDoc)
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    /**
     * Get tipoDoc
     *
     * @return string
     */
    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Persona
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Persona
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
     * @return Persona
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Persona
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     *
     * @return Persona
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set creadoPor
     *
     * @param \AppBundle\Entity\User $creadoPor
     *
     * @return Persona
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
     * @return Persona
     */
    public function setActualizadoPor(\AppBundle\Entity\User $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direcciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add direccione
     *
     * @param \AppBundle\Entity\PersonaDireccion $direccione
     *
     * @return Persona
     */
    public function addDireccione(\AppBundle\Entity\PersonaDireccion &$direccione)
    {
        $this->direcciones[] = $direccione;

        $direccione->setPersona($this);

        return $this;
    }

    /**
     * Remove direccione
     *
     * @param \AppBundle\Entity\PersonaDireccion $direccione
     */
    public function removeDireccione(\AppBundle\Entity\PersonaDireccion $direccione)
    {
        $this->direcciones->removeElement($direccione);
    }

    /**
     * Get direcciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirecciones()
    {
        return $this->direcciones;
    }

    /**
     * Add contacto
     *
     * @param \AppBundle\Entity\PersonaContacto $contacto
     *
     * @return Persona
     */
    public function addContacto(\AppBundle\Entity\PersonaContacto $contacto)
    {
        $this->contactos[] = $contacto;

        return $this;
    }

    /**
     * Remove contacto
     *
     * @param \AppBundle\Entity\PersonaContacto $contacto
     */
    public function removeContacto(\AppBundle\Entity\PersonaContacto $contacto)
    {
        $this->contactos->removeElement($contacto);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContactos()
    {
        return $this->contactos;
    }
}
