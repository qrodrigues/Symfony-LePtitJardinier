<?php

namespace App\Entity;

use App\Repository\TaillerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaillerRepository::class)
 */
class Tailler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Haie::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="code")
     */
    private $code_haie;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $hauteur;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $longueur;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="no")
     */
    private $devis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeHaie(): ?Haie
    {
        return $this->code_haie;
    }

    public function setCodeHaie(?Haie $code_haie): self
    {
        $this->code_haie = $code_haie;

        return $this;
    }

    public function getHauteur(): ?string
    {
        return $this->hauteur;
    }

    public function setHauteur(string $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }

    public function setLongueur(string $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;

        return $this;
    }
}
