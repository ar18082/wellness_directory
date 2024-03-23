<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AdresseNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AdresseRue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $inscription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TypeUtilisateur = null;

    #[ORM\Column(nullable: true)]
    private ?int $NbEssaisInfructueux = null;

    #[ORM\Column]
    private ?bool $Banni = null;

    #[ORM\Column]
    private ?bool $inscriptConfirm = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Internaute $internaute = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Prestataire $prestataire = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?VilleCodePost $VilleCodePost = null;

    public function __construct()
    {
        $this->inscription = new \DateTime(); 
        $this->Banni = false;
        $this->inscriptConfirm =false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAdresseNumber(): ?string
    {
        return $this->AdresseNumber;
    }

    public function setAdresseNumber(?string $AdresseNumber): self
    {
        $this->AdresseNumber = $AdresseNumber;

        return $this;
    }

    public function getAdresseRue(): ?string
    {
        return $this->AdresseRue;
    }

    public function setAdresseRue(?string $AdresseRue): self
    {
        $this->AdresseRue = $AdresseRue;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->inscription;
    }

    public function setInscription(\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getTypeUtilisateur(): ?string
    {
        return $this->TypeUtilisateur;
    }

    public function setTypeUtilisateur(?string $TypeUtilisateur): self
    {
        $this->TypeUtilisateur = $TypeUtilisateur;

        return $this;
    }

    public function getNbEssaisInfructueux(): ?int
    {
        return $this->NbEssaisInfructueux;
    }

    public function setNbEssaisInfructueux(?int $NbEssaisInfructueux): self
    {
        $this->NbEssaisInfructueux = $NbEssaisInfructueux;

        return $this;
    }

    public function isBanni(): ?bool
    {
        return $this->Banni;
    }

    public function setBanni(bool $Banni): self
    {
        $this->Banni = $Banni;

        return $this;
    }

    public function isInscriptConfirm(): ?bool
    {
        return $this->inscriptConfirm;
    }

    public function setInscriptConfirm(bool $inscriptConfirm): self
    {
        $this->inscriptConfirm = $inscriptConfirm;

        return $this;
    }

    public function getInternaute(): ?Internaute
    {
        return $this->internaute;
    }

    public function setInternaute(?Internaute $internaute): self
    {
        $this->internaute = $internaute;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getVilleCodePost(): ?VilleCodePost
    {
        return $this->VilleCodePost;
    }

    public function setVilleCodePost(?VilleCodePost $VilleCodePost): static
    {
        $this->VilleCodePost = $VilleCodePost;

        return $this;
    }

}