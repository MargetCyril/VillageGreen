<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_facture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $livreur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $suivi = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $id_panier = null;

    /**
     * @var Collection<int, BonLivraison>
     */
    #[ORM\OneToMany(targetEntity: BonLivraison::class, mappedBy: 'facture')]
    private Collection $id_bon_livraison;

    public function __construct()
    {
        $this->id_bon_livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFacture(): ?\DateTime
    {
        return $this->date_facture;
    }

    public function setDateFacture(\DateTime $date_facture): static
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getLivreur(): ?string
    {
        return $this->livreur;
    }

    public function setLivreur(?string $livreur): static
    {
        $this->livreur = $livreur;

        return $this;
    }

    public function getSuivi(): ?string
    {
        return $this->suivi;
    }

    public function setSuivi(?string $suivi): static
    {
        $this->suivi = $suivi;

        return $this;
    }

    public function getIdPanier(): ?Commande
    {
        return $this->id_panier;
    }

    public function setIdPanier(Commande $id_panier): static
    {
        $this->id_panier = $id_panier;

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
            $idBonLivraison->setFacture($this);
        }

        return $this;
    }

    public function removeIdBonLivraison(BonLivraison $idBonLivraison): static
    {
        if ($this->id_bon_livraison->removeElement($idBonLivraison)) {
            // set the owning side to null (unless already changed)
            if ($idBonLivraison->getFacture() === $this) {
                $idBonLivraison->setFacture(null);
            }
        }

        return $this;
    }
}
