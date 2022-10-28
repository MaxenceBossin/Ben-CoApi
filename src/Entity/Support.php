<?php

namespace App\Entity;

use App\Repository\SupportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: SupportRepository::class)]
#[ApiResource()]
class Support
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_src = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne]
    private ?Dumpster $dumpster_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fk_user_id = null;

    #[ORM\ManyToOne]
    private ?User $fk_admin_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageSrc(): ?string
    {
        return $this->image_src;
    }

    public function setImageSrc(?string $image_src): self
    {
        $this->image_src = $image_src;

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

    public function getDumpsterId(): ?Dumpster
    {
        return $this->dumpster_id;
    }

    public function setDumpsterId(?Dumpster $dumpster_id): self
    {
        $this->dumpster_id = $dumpster_id;

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

    public function getFkAdminId(): ?User
    {
        return $this->fk_admin_id;
    }

    public function setFkAdminId(?User $fk_admin_id): self
    {
        $this->fk_admin_id = $fk_admin_id;

        return $this;
    }
}
