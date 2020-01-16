<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ApiResource(attributes={
 *     "normalization_context": {"groups"={"recettes"}}, "fetchEager": true
 * })
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"types", "recettes"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"types", "recettes"})
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes"})
     */
    private $tempsprepa;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes"})
     */
    private $tempscuisson;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes"})
     */
    private $conseil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Types", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredients", inversedBy="recettes")
     * @Groups({"types", "recettes"})
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

    public function getTempsprepa(): ?string
    {
        return $this->tempsprepa;
    }

    public function setTempsprepa(string $tempsprepa): self
    {
        $this->tempsprepa = $tempsprepa;

        return $this;
    }

    public function getTempscuisson(): ?string
    {
        return $this->tempscuisson;
    }

    public function setTempscuisson(string $tempscuisson): self
    {
        $this->tempscuisson = $tempscuisson;

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
