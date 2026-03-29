<?php

namespace App\Entity;

use App\Repository\ExpertRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpertRepository::class)]
#[ORM\Table(name: 'experts')]
class Expert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private string $image = '';

    #[ORM\Column(length: 100)]
    private string $name = '';

    #[ORM\Column(length: 150)]
    private string $role = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(type: 'text')]
    private string $quote = '';

    #[ORM\Column(length: 50)]
    private string $timestamp = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getImage(): string { return $this->image; }
    public function setImage(string $v): static { $this->image = $v; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getRole(): string { return $this->role; }
    public function setRole(string $v): static { $this->role = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getQuote(): string { return $this->quote; }
    public function setQuote(string $v): static { $this->quote = $v; return $this; }
    public function getTimestamp(): string { return $this->timestamp; }
    public function setTimestamp(string $v): static { $this->timestamp = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['image' => $this->image, 'name' => $this->name, 'role' => $this->role, 'title' => $this->title, 'quote' => $this->quote, 'timestamp' => $this->timestamp];
    }
}
