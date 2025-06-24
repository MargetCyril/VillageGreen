<?php

namespace App\Entity;

use App\Repository\LivrerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivrerRepository::class)]
class Livrer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantite_livre = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'livrers')]
    private Collection $id_produit;

    /**
     * @var Collection<int, BonLivraison>
     */
    #[ORM\OneToMany(targetEntity: BonLivraison::class, mappedBy: 'livrer')]
    private Collection $id_bon_livraison;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
        $this->id_bon_livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteLivre(): ?string
    {
        return $this->quantite_livre;
    }

    public function setQuantiteLivre(?string $quantite_livre): static
    {
        $this->quantite_livre = $quantite_livre;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(Produit $idProduit): static
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit->add($idProduit);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): static
    {
        $this->id_produit->removeElement($idProduit);

        return $this;
    }

    /**
     * @return Collection<int, BonLivraison>
     */
    public function getIdBonLivraison(): Collection
    {
        return $this->id_bon_livraison;
    }

    public function addIdBonLivraison(BonLivraison $idBonLivraison): static
    {
        if (!$this->id_bon_livraison->contains($idBonLivraison)) {
            $this->id_bon_livraison->add($idBonLivraison);
            $idBonLivraison->setLivrer($this);
        }

        return $this;
    }

    public function removeIdBonLivraison(BonLivraison $idBonLivraison): static
    {
        if ($this->id_bon_livraison->removeElement($idBonLivraison)) {
            // set the owning side to null (unless already changed)
            if ($idBonLivraison->getLivrer() === $this) {
                $idBonLivraison->setLivrer(null);
            }
        }

        return $this;
    }
}
