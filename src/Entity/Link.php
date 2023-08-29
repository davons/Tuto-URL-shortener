<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LinkRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['link:read']],
    denormalizationContext: ['groups' => ['link:create', 'link:update']],
)]

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[Groups(['link:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['link:read', 'link:create', 'link:update'])]
    #[Assert\Url]
    #[ORM\Column(length: 255)]
    private ?string $shortLink = null;

    #[Groups(['link:read', 'link:create', 'link:update'])]
    #[Assert\Url]
    #[ORM\Column(length: 255)]
    private ?string $fullLink = null;

    #[Groups(['link:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups(['link:read'])]
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\NotNull]
    #[ORM\ManyToOne(inversedBy: 'links')]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortLink(): ?string
    {
        return $this->shortLink;
    }

    public function setShortLink(string $shortLink): static
    {
        $this->shortLink = $shortLink;

        return $this;
    }

    public function getFullLink(): ?string
    {
        return $this->fullLink;
    }

    public function setFullLink(string $fullLink): static
    {
        $this->fullLink = $fullLink;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
