<?php

namespace App\Entity;

use App\Repository\AnlagestrategItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnlagestrategItemRepository::class)]
#[ORM\Table(name: 'anlagestrategen')]
class AnlagestrategItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $badge = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(length: 100)]
    private string $author = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getBadge(): string { return $this->badge; }
    public function setBadge(string $v): static { $this->badge = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getAuthor(): string { return $this->author; }
    public function setAuthor(string $v): static { $this->author = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['badge' => $this->badge, 'title' => $this->title, 'author' => $this->author];
    }
}
