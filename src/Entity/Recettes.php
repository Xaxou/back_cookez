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
 *     "normalization_context": {"groups"={"recettes"}}, "fetchEager": true,
 *     "denormalization_context": {"groups"={"recettes"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"types", "recettes", "user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes", "user"})
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Types", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"recettes"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredients", inversedBy="recettes")
     * @ORM\JoinTable(name="recettes_ingredients",
     *  joinColumns={
     *      @ORM\JoinColumn(name="recettes_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="ingredients_id", referencedColumnName="id")
     *  })
     * @Groups({"types", "recettes"})
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="recettes")
     * @Groups({"types", "recettes" })
     */
    private $createur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notes", mappedBy="recette")
     * @Groups({"types", "recettes"})
     */
    private $notes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"types", "recettes"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"types", "recettes"})
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"types", "recettes"})
     */
    private $nbrPersonnes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Preparation", mappedBy="recette", cascade={"remove"})
     * @Groups({"recettes"})
     */
    private $preparations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cuisson", mappedBy="recette", cascade={"remove"})
     * @Groups({"recettes"})
     */
    private $cuissons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quantite", mappedBy="recette", cascade={"remove"})
     * @Groups({"recettes"})
     */
    private $quantites;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"recettes", "user"})
     */
    private $dateCreation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etiquettes", inversedBy="recettes")
     * @ORM\JoinTable(name="recettes_etiquettes",
     *  joinColumns={
     *      @ORM\JoinColumn(name="recettes_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="etiquettes_id", referencedColumnName="id")
     *  })
     * @Groups({"etiquettes","recettes"})
     */
    private $etiquettes;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->preparations = new ArrayCollection();
        $this->cuissons = new ArrayCollection();
        $this->quantites = new ArrayCollection();
        $this->etiquettes = new ArrayCollection();
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

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection|Notes[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setRecette($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getRecette() === $this) {
                $note->setRecette(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getNbrPersonnes(): ?int
    {
        return $this->nbrPersonnes;
    }

    public function setNbrPersonnes(int $nbrPersonnes): self
    {
        $this->nbrPersonnes = $nbrPersonnes;

        return $this;
    }

    /**
     * @return Collection|Preparation[]
     */
    public function getPreparations(): Collection
    {
        return $this->preparations;
    }

    public function addPreparation(Preparation $preparation): self
    {
        if (!$this->preparations->contains($preparation)) {
            $this->preparations[] = $preparation;
            $preparation->setRecette($this);
        }

        return $this;
    }

    public function removePreparation(Preparation $preparation): self
    {
        if ($this->preparations->contains($preparation)) {
            $this->preparations->removeElement($preparation);
            // set the owning side to null (unless already changed)
            if ($preparation->getRecette() === $this) {
                $preparation->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cuisson[]
     */
    public function getCuissons(): Collection
    {
        return $this->cuissons;
    }

    public function addCuisson(Cuisson $cuisson): self
    {
        if (!$this->cuissons->contains($cuisson)) {
            $this->cuissons[] = $cuisson;
            $cuisson->setRecette($this);
        }

        return $this;
    }

    public function removeCuisson(Cuisson $cuisson): self
    {
        if ($this->cuissons->contains($cuisson)) {
            $this->cuissons->removeElement($cuisson);
            // set the owning side to null (unless already changed)
            if ($cuisson->getRecette() === $this) {
                $cuisson->setRecette(null);
            }
        }

        return $this;
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
            $quantite->setRecette($this);
        }

        return $this;
    }

    public function removeQuantite(Quantite $quantite): self
    {
        if ($this->quantites->contains($quantite)) {
            $this->quantites->removeElement($quantite);
            // set the owning side to null (unless already changed)
            if ($quantite->getRecette() === $this) {
                $quantite->setRecette(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection|Etiquettes[]
     */
    public function getEtiquettes(): Collection
    {
        return $this->etiquettes;
    }

    public function addEtiquette(Etiquettes $etiquette): self
    {
        if (!$this->etiquettes->contains($etiquette)) {
            $this->etiquettes[] = $etiquette;
        }

        return $this;
    }

    public function removeEtiquette(Etiquettes $etiquette): self
    {
        if ($this->etiquettes->contains($etiquette)) {
            $this->etiquettes->removeElement($etiquette);
        }

        return $this;
    }
}
