<?php

namespace App\Entity;

use App\Repository\InternauteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternauteRepository::class)]
class Internaute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(nullable: true)]
    private ?bool $newsletter = null;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Abus::class)]
    private Collection $abuses;

    #[ORM\OneToMany(mappedBy: 'internaute', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    

    public function __construct()
    {
        $this->abuses = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): static
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return Collection<int, Abus>
     */
    public function getAbuses(): Collection
    {
        return $this->abuses;
    }

    public function addAbuse(Abus $abuse): static
    {
        if (!$this->abuses->contains($abuse)) {
            $this->abuses->add($abuse);
            $abuse->setInternaute($this);
        }

        return $this;
    }

    public function removeAbuse(Abus $abuse): static
    {
        if ($this->abuses->removeElement($abuse)) {
            // set the owning side to null (unless already changed)
            if ($abuse->getInternaute() === $this) {
                $abuse->setInternaute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setInternaute($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getInternaute() === $this) {
                $commentaire->setInternaute(null);
            }
        }

        return $this;
    }

   
}
