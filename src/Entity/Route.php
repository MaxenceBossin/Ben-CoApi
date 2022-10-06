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

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column]
    private array $routeJson = [];

    #[ORM\ManyToOne(inversedBy: 'routes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $fkUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->DateStart;
    }

    public function setDateStart(\DateTimeInterface $DateStart): self
    {
        $this->DateStart = $DateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getRouteJson(): array
    {
        return $this->routeJson;
    }

    public function setRouteJson(array $routeJson): self
    {
        $this->routeJson = $routeJson;

        return $this;
    }

    public function getFkUser(): ?user
    {
        return $this->fkUser;
    }

    public function setFkUser(?user $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }
}
