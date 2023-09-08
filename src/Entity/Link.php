<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\LinkProcessor;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LinkRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: LinkProcessor::class),
        new Get(),
        new Put(processor: LinkProcessor::class),
        new Delete(processor: LinkProcessor::class),
    ],
    normalizationContext: ['groups' => ['link:read']],
    denormalizationContext: ['groups' => ['link:create', 'link:update']],
    security: ("is_granted('ROLE_USER')"),
)]

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[Groups(['link:read'])]
    private ?Uuid $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $shortLink = null;

    #[ORM\Column(length: 255)]
    #[Assert\Url(
        message: "L'URL {{ value }} n'est pas valide.",
    )]
    #[Groups(['link:read', 'link:create', 'link:update'])]
    private ?string $fullLink = null;

    #[ORM\Column]
    #[Groups(['link:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['link:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['link:read'])]
    private ?User $owner = null;

    public function getId(): ?Uuid
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
