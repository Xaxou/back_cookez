<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context": {"groups"={"quantites"}}, "fetchEager": true,
 *     "denormalization_context": {"groups"={"quantites"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\QuantiteRepository")
 */
class Quantite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"recettes", "quantites"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recettes", "ingredients", "quantites"})
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ingredients", inversedBy="quantites")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"recettes", "quantites"})
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="quantites")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ingredients", "quantites"})
     */
    private $recette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIngredient(): ?Ingredients
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredients $ingredient): self
    {
        $this->ingredient = $ingredient;

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
}
