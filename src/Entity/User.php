<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $id_pro = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_livraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_facturation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville_livraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville_facturation = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $code_postal_livraison = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $code_postal_facturation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ref_fournisseur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coeff_achat = null;

    #[ORM\ManyToOne(inversedBy: 'Client')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commercial $commercial = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getIdPro(): ?string
    {
        return $this->id_pro;
    }

    public function setIdPro(?string $id_pro): static
    {
        $this->id_pro = $id_pro;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(?string $adresse_livraison): static
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getAdresseFacturation(): ?string
    {
        return $this->adresse_facturation;
    }

    public function setAdresseFacturation(?string $adresse_facturation): static
    {
        $this->adresse_facturation = $adresse_facturation;

        return $this;
    }

    public function getVilleLivraison(): ?string
    {
        return $this->ville_livraison;
    }

    public function setVilleLivraison(?string $ville_livraison): static
    {
        $this->ville_livraison = $ville_livraison;

        return $this;
    }

    public function getVilleFacturation(): ?string
    {
        return $this->ville_facturation;
    }

    public function setVilleFacturation(?string $ville_facturation): static
    {
        $this->ville_facturation = $ville_facturation;

        return $this;
    }

    public function getCodePostalLivraison(): ?string
    {
        return $this->code_postal_livraison;
    }

    public function setCodePostalLivraison(?string $code_postal_livraison): static
    {
        $this->code_postal_livraison = $code_postal_livraison;

        return $this;
    }

    public function getCodePostalFacturation(): ?string
    {
        return $this->code_postal_facturation;
    }

    public function setCodePostalFacturation(?string $code_postal_facturation): static
    {
        $this->code_postal_facturation = $code_postal_facturation;

        return $this;
    }

    public function getRefFournisseur(): ?string
    {
        return $this->ref_fournisseur;
    }

    public function setRefFournisseur(?string $ref_fournisseur): static
    {
        $this->ref_fournisseur = $ref_fournisseur;

        return $this;
    }

    public function getCoeffAchat(): ?string
    {
        return $this->coeff_achat;
    }

    public function setCoeffAchat(?string $coeff_achat): static
    {
        $this->coeff_achat = $coeff_achat;

        return $this;
    }

    public function getCommercial(): ?Commercial
    {
        return $this->commercial;
    }

    public function setCommercial(?Commercial $commercial): static
    {
        $this->commercial = $commercial;

        return $this;
    }
}
