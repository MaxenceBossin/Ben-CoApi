<?php

namespace App\Entity;

use App\Repository\DumpsterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DumpsterRepository::class)]
class Dumpster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\OneToMany(mappedBy: 'dumpsters', targetEntity: Support::class)]
    private Collection $supports;

    public function __construct()
    {
        $this->supports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, Support>
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupports(Support $supports): self
    {
        if (!$this->supports->contains($supports)) {
            $this->supports->add($supports);
            $supports->setDumpsters($this);
        }

        return $this;
    }

    public function removeSupports(Support $supports): self
    {
        if ($this->supports->removeElement($supports)) {
            // set the owning side to null (unless already changed)
            if ($supports->getDumpsters() === $this) {
                $supports->setDumpsters(null);
            }
        }

        return $this;
    }
}
