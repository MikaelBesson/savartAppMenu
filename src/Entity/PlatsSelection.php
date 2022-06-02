<?php

namespace App\Entity;

use App\Repository\PlatsSelectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatsSelectionRepository::class)]
class PlatsSelection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?user $user;

    #[ORM\ManyToOne(targetEntity: Repas::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?repas $repas;

    #[ORM\ManyToOne(targetEntity: Plat::class)]
    private ?plat $plat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRepas(): ?repas
    {
        return $this->repas;
    }

    public function setRepas(?repas $repas): self
    {
        $this->repas = $repas;

        return $this;
    }

    public function getPlat(): ?plat
    {
        return $this->plat;
    }

    public function setPlat(?plat $plat): self
    {
        $this->plat = $plat;

        return $this;
    }
}
