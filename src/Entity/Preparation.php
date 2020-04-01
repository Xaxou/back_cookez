<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context": {"groups"={"preparation", "recettes"}}, "fetchEager": true
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PreparationRepository")
 */
class Preparation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recettes", 
     *          "preparation",
     * })
     */
    private $etapeText;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="preparations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recettes", 
     *          "preparation",
     * })
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
