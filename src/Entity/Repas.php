<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepasRepository::class)]
class Repas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $date_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?DateTimeImmutable
    {
        return $this->date_at;
    }

    public function setDateAt(DateTimeImmutable $date_at): self
    {
        $this->date_at = $date_at;

        return $this;
    }
}
