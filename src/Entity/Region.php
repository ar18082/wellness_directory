<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: VilleCodePost::class)]
    private Collection $villeCodePosts;

    public function __construct()
    {
        $this->villeCodePosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, VilleCodePost>
     */
    public function getVilleCodePosts(): Collection
    {
        return $this->villeCodePosts;
    }

    public function addVilleCodePost(VilleCodePost $villeCodePost): static
    {
        if (!$this->villeCodePosts->contains($villeCodePost)) {
            $this->villeCodePosts->add($villeCodePost);
            $villeCodePost->setRegion($this);
        }

        return $this;
    }

    public function removeVilleCodePost(VilleCodePost $villeCodePost): static
    {
        if ($this->villeCodePosts->removeElement($villeCodePost)) {
            // set the owning side to null (unless already changed)
            if ($villeCodePost->getRegion() === $this) {
                $villeCodePost->setRegion(null);
            }
        }

        return $this;
    }
}
