<?php

namespace App\Entity;

use App\Repository\BonLivraisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BonLivraisonRepository::class)]
class BonLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_bon_livraison = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_envoi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBonLivraison(): ?int
    {
        return $this->id_bon_livraison;
    }

    public function setIdBonLivraison(int $id_bon_livraison): static
    {
        $this->id_bon_livraison = $id_bon_livraison;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTime
    {
        return $this->date_envoi;
    }

    public function setDateEnvoi(\DateTime $date_envoi): static
    {
        $this->date_envoi = $date_envoi;

        return $this;
    }

}
