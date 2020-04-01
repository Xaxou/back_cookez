<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CuissonRepository")
 */
class Cuisson
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
    private $etapeText;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="cuissons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\Column(type="integer")
     */
    private $numEtape;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtapeText(): ?string
    {
        return $this->etapeText;
    }

    public function setEtapeText(string $etapeText): self
    {
        $this->etapeText = $etapeText;

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

    public function getNumEtape(): ?int
    {
        return $this->numEtape;
    }

    public function setNumEtape(int $numEtape): self
    {
        $this->numEtape = $numEtape;

        return $this;
    }
}
