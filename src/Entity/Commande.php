<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]
    private ?string $prix_final = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $moyen_payement = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]
    private ?string $total = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_achat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $reduction = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_user = null;

    /**
     * @var Collection<int, panier>
     */
    #[ORM\OneToMany(targetEntity: panier::class, mappedBy: 'commande')]
    private Collection $id_panier;

    public function __construct()
    {
        $this->id_panier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixFinal(): ?string
    {
        return $this->prix_final;
    }

    public function setPrixFinal(?string $prix_final): static
    {
        $this->prix_final = $prix_final;

        return $this;
    }

    public function getMoyenPayement(): ?string
    {
        return $this->moyen_payement;
    }

    public function setMoyenPayement(?string $moyen_payement): static
    {
        $this->moyen_payement = $moyen_payement;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTime $date_achat): static
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getReduction(): ?string
    {
        return $this->reduction;
    }

    public function setReduction(?string $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getRefUser(): ?User
    {
        return $this->ref_user;
    }

    public function setRefUser(?User $ref_user): static
    {
        $this->ref_user = $ref_user;

        return $this;
    }

    /**
     * @return Collection<int, panier>
     */
    public function getIdPanier(): Collection
    {
        return $this->id_panier;
    }

    public function addIdPanier(panier $idPanier): static
    {
        if (!$this->id_panier->contains($idPanier)) {
            $this->id_panier->add($idPanier);
            $idPanier->setCommande($this);
        }

        return $this;
    }

    public function removeIdPanier(panier $idPanier): static
    {
        if ($this->id_panier->removeElement($idPanier)) {
            // set the owning side to null (unless already changed)
            if ($idPanier->getCommande() === $this) {
                $idPanier->setCommande(null);
            }
        }

        return $this;
    }
}
