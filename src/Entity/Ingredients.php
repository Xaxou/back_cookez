<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext={"groups"={"ingredients", "catingredient"}})
 * @ORM\Entity(repositoryClass="App\Repository\IngredientsRepository")
 */
class Ingredients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"categories", 
     *          "recettes", 
     *          "ingredients",
     *          "catingredient", 
     *          "types"
     *      })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categories", 
     *          "recettes", 
     *          "ingredients",
     *          "catingredient", 
     *          "types"
     *         })
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"categories", 
     *          "recettes", 
     *          "ingredients",
     *          "catingredient", 
     *          "types"
     *         })
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"recettes", "catingredient"})
     * 
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quantite", mappedBy="ingredient")
     */
    private $quantites;


    public function __construct()
    {
        $this->quantites = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return Collection|Quantite[]
     */
    public function getQuantites(): Collection
    {
        return $this->quantites;
    }

    public function addQuantite(Quantite $quantite): self
    {
        if (!$this->quantites->contains($quantite)) {
            $this->quantites[] = $quantite;
            $quantite->setIngredient($this);
        }

        return $this;
    }

    public function removeQuantite(Quantite $quantite): self
    {
        if ($this->quantites->contains($quantite)) {
            $this->quantites->removeElement($quantite);
            // set the owning side to null (unless already changed)
            if ($quantite->getIngredient() === $this) {
                $quantite->setIngredient(null);
            }
        }

        return $this;
    }

}
