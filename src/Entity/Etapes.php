<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext={"groups"={"etapes"}})
 * @ORM\Entity(repositoryClass="App\Repository\EtapesRepository")
 */
class Etapes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"etapes"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"etapes"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"etapes"})
     */
    private $recette;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recettes"})
     */
    private $onglet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRecette(): ?Recettes
    {
        return $this->recette;
    }

    public function setRecette(?Recettes $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function __toString()
    {
        return $this->getDescription();
    }

    public function getOnglet(): ?string
    {
        return $this->onglet;
    }

    public function setOnglet(string $onglet): self
    {
        $this->onglet = $onglet;

        return $this;
    }
}
