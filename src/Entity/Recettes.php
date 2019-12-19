<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temps_prepa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temps_cuisson;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $conseil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Types", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredients", inversedBy="recettes")
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getTempsPrepa(): ?string
    {
        return $this->temps_prepa;
    }

    public function setTempsPrepa(string $temps_prepa): self
    {
        $this->temps_prepa = $temps_prepa;

        return $this;
    }

    public function getTempsCuisson(): ?string
    {
        return $this->temps_cuisson;
    }

    public function setTempsCuisson(string $temps_cuisson): self
    {
        $this->temps_cuisson = $temps_cuisson;

        return $this;
    }

    public function getConseil(): ?string
    {
        return $this->conseil;
    }

    public function setConseil(?string $conseil): self
    {
        $this->conseil = $conseil;

        return $this;
    }

    public function getType(): ?Types
    {
        return $this->type;
    }

    public function setType(?Types $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Ingredients[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredients $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }
}
