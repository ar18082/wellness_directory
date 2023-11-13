<?php

namespace App\Entity;

use App\Repository\CategorieDeServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieDeServicesRepository::class)]
class CategorieDeServices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $EnAvant = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Valide = null;

    #[ORM\OneToMany(mappedBy: 'categorieDeServices', targetEntity: Proposer::class)]
    private Collection $proposers;

    #[ORM\OneToMany(mappedBy: 'categorieDeServices', targetEntity: Promotion::class)]
    private Collection $promotions;

    public function __construct()
    {
        $this->proposers = new ArrayCollection();
        $this->promotions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isEnAvant(): ?bool
    {
        return $this->EnAvant;
    }

    public function setEnAvant(?bool $EnAvant): static
    {
        $this->EnAvant = $EnAvant;

        return $this;
    }

    public function isValide(): ?bool
    {
        return $this->Valide;
    }

    public function setValide(?bool $Valide): static
    {
        $this->Valide = $Valide;

        return $this;
    }

    /**
     * @return Collection<int, Proposer>
     */
    public function getProposers(): Collection
    {
        return $this->proposers;
    }

    public function addProposer(Proposer $proposer): static
    {
        if (!$this->proposers->contains($proposer)) {
            $this->proposers->add($proposer);
            $proposer->setCategorieDeServices($this);
        }

        return $this;
    }

    public function removeProposer(Proposer $proposer): static
    {
        if ($this->proposers->removeElement($proposer)) {
            // set the owning side to null (unless already changed)
            if ($proposer->getCategorieDeServices() === $this) {
                $proposer->setCategorieDeServices(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): static
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions->add($promotion);
            $promotion->setCategorieDeServices($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): static
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getCategorieDeServices() === $this) {
                $promotion->setCategorieDeServices(null);
            }
        }

        return $this;
    }
}
