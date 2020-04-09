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
 *     "normalization_context": {"groups"={"types"}}, "fetchEager": true,
 *     "denormalization_context": {"groups"={"types"}}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\TypesRepository")
 */
class Types
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"types","recettes"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recettes", mappedBy="type", fetch="EAGER")
     * @Groups({"types"})
     *
     */
    private $recettes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"types"})
     */
    private $image;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
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

    /**
     * @return Collection|Recettes[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recettes $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->setType($this);
        }

        return $this;
    }

    public function removeRecette(Recettes $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getType() === $this) {
                $recette->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
