<?php

namespace App\Entity;

use App\Repository\SupportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupportRepository::class)]
class Support
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $imageSrc = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'garbageCollector')]
    private ?dumpster $dumpsters = null;

    #[ORM\ManyToOne(inversedBy: 'supports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $fkUser = null;

    #[ORM\ManyToOne(inversedBy: 'supports')]
    private ?user $fkAdmin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageSrc(): ?string
    {
        return $this->imageSrc;
    }

    public function setImageSrc(?string $imageSrc): self
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDumpsters(): ?dumpster
    {
        return $this->dumpsters;
    }

    public function setDumpsters(?dumpster $dumpsters): self
    {
        $this->dumpsters = $dumpsters;

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

    public function getFkAdmin(): ?user
    {
        return $this->fkAdmin;
    }

    public function setFkAdmin(?user $fkAdmin): self
    {
        $this->fkAdmin = $fkAdmin;

        return $this;
    }
}
