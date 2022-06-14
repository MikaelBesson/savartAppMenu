<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'boolean')]
    private ?bool $is_active;


    #[ORM\OneToOne(targetEntity: Recipe::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image;

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

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }


    public function getPlat(): ?Recipe
    {
        return $this->plat;
    }

    public function setPlat(Recipe $recipe): self
    {
        $this->plat = $recipe;

        return $this;
    }

    public function getImage(): ?string
    {
        return '/upload/images/ingredient/' . $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    #[Pure] public function __toString(): string
    {
        return $this->getName();
    }
}
