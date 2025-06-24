<?php

namespace App\Entity;

use App\Repository\CommercialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommercialRepository::class)]
class Commercial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_commercial = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'commercial')]
    private Collection $Client;

    public function __construct()
    {
        $this->Client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefCommercial(): ?User
    {
        return $this->ref_commercial;
    }

    public function setRefCommercial(User $ref_commercial): static
    {
        $this->ref_commercial = $ref_commercial;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getClient(): Collection
    {
        return $this->Client;
    }

    public function addClient(User $client): static
    {
        if (!$this->Client->contains($client)) {
            $this->Client->add($client);
            $client->setCommercial($this);
        }

        return $this;
    }

    public function removeClient(User $client): static
    {
        if ($this->Client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCommercial() === $this) {
                $client->setCommercial(null);
            }
        }

        return $this;
    }
}
