<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfertaRepository")
 */
class Oferta
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
    private $descripcion;

    /**
     * @ORM\Column(type="date")
     */
    private $data_pub;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empresa", inversedBy="ofertas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidato", mappedBy="oferta")
     */
    private $candidatos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    public function __construct()
    {
        $this->candidatos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDataPub(): ?\DateTimeInterface
    {
        return $this->data_pub;
    }

    public function setDataPub(\DateTimeInterface $data_pub): self
    {
        $this->data_pub = $data_pub;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return Collection|Candidato[]
     */
    public function getCandidatos(): Collection
    {
        return $this->candidatos;
    }

    public function addCandidato(Candidato $candidato): self
    {
        if (!$this->candidatos->contains($candidato)) {
            $this->candidatos[] = $candidato;
            $candidato->setOferta($this);
        }

        return $this;
    }

    public function removeCandidato(Candidato $candidato): self
    {
        if ($this->candidatos->contains($candidato)) {
            $this->candidatos->removeElement($candidato);
            // set the owning side to null (unless already changed)
            if ($candidato->getOferta() === $this) {
                $candidato->setOferta(null);
            }
        }

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }
}
