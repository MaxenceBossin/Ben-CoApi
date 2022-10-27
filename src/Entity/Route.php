<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_start = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_end = null;

    #[ORM\Column]
    private array $route_json = [];

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fk_user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeImmutable
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeImmutable $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeImmutable
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeImmutable $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getRouteJson(): array
    {
        return $this->route_json;
    }

    public function setRouteJson(array $route_json): self
    {
        $this->route_json = $route_json;

        return $this;
    }

    public function getFkUserId(): ?User
    {
        return $this->fk_user_id;
    }

    public function setFkUserId(?User $fk_user_id): self
    {
        $this->fk_user_id = $fk_user_id;

        return $this;
    }
}
