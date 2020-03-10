<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(normalizationContext={"groups"={"notes"}})
 * @ORM\Entity(repositoryClass="App\Repository\NotesRepository")
 */
class Notes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"notes", "recettes"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"notes", "recettes"})
     */
    private $etoiles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"notes", "recettes"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtoiles(): ?int
    {
        return $this->etoiles;
    }

    public function setEtoiles(int $etoiles): self
    {
        $this->etoiles = $etoiles;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
