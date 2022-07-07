<?php

namespace App\Entity;

use App\Repository\UserRecipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: UserRecipeRepository::class)]
class UserRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userRecipes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private $user;

    #[ORM\ManyToOne(targetEntity: Recipe::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $recipe;

    #[ORM\Column(type: 'string', length: 5)]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getDate(): ?String
    {
        return $this->date;
    }

    public function setDate(String $date): self
    {
        $this->date = $date;

        return $this;
    }
}
