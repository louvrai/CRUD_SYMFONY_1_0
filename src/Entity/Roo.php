<?php

namespace App\Entity;

use App\Repository\RooRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RooRepository::class)]
class Roo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'roo', targetEntity: Car::class)]
    private Collection $nb_roo;

    public function __construct()
    {
        $this->nb_roo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getNbRoo(): Collection
    {
        return $this->nb_roo;
    }

    public function addNbRoo(Car $nbRoo): static
    {
        if (!$this->nb_roo->contains($nbRoo)) {
            $this->nb_roo->add($nbRoo);
            $nbRoo->setRoo($this);
        }

        return $this;
    }

    public function removeNbRoo(Car $nbRoo): static
    {
        if ($this->nb_roo->removeElement($nbRoo)) {
            // set the owning side to null (unless already changed)
            if ($nbRoo->getRoo() === $this) {
                $nbRoo->setRoo(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return (string)$this->getName();
    }
}
