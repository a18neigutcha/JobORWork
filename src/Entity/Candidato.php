<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidatoRepository")
 */
class Candidato
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Oferta", inversedBy="candidatos")
     */
    private $oferta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estudios;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getOferta(): ?Oferta
    {
        return $this->oferta;
    }

    public function setOferta(?Oferta $oferta): self
    {
        $this->oferta = $oferta;

        return $this;
    }

    public function getEstudios(): ?string
    {
        return $this->estudios;
    }

    public function setEstudios(string $estudios): self
    {
        $this->estudios = $estudios;

        return $this;
    }
}
