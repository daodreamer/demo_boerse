<?php

namespace App\Entity;

use App\Repository\GruppeNewsItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GruppeNewsItemRepository::class)]
#[ORM\Table(name: 'gruppe_news')]
class GruppeNewsItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $label = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(length: 80)]
    private string $link = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getLabel(): string { return $this->label; }
    public function setLabel(string $v): static { $this->label = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getLink(): string { return $this->link; }
    public function setLink(string $v): static { $this->link = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['label' => $this->label, 'title' => $this->title, 'link' => $this->link];
    }
}
