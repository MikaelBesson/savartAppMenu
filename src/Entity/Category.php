<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Recipe::class)]
    private $recipes;

    #[Pure] public function __construct()
    {
        $this->plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Recipe $recipe): self
    {
        if (!$this->plats->contains($recipe)) {
            $this->plats[] = $recipe;
            $recipe->setCategory($this);
        }

        return $this;
    }

    public function removePlat(Recipe $recipe): self
    {
        if ($this->plats->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }
        return $this;
    }
}
