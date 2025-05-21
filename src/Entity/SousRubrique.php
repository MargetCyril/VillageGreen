<?php

namespace App\Entity;

use App\Repository\SousRubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousRubriqueRepository::class)]
class SousRubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_sousrub = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'sousRubriques')]
    private ?Rubrique $libelle_rub = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleSousrub(): ?string
    {
        return $this->libelle_sousrub;
    }

    public function setLibelleSousrub(string $libelle_sousrub): static
    {
        $this->libelle_sousrub = $libelle_sousrub;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLibelleRub(): ?Rubrique
    {
        return $this->libelle_rub;
    }

    public function setLibelleRub(?Rubrique $libelle_rub): static
    {
        $this->libelle_rub = $libelle_rub;

        return $this;
    }


    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getLibelleSousrub() === $this) {
                $produit->setLibelleSousrub(null);
            }
        }

        return $this;
    }
}
