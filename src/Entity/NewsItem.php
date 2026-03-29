<?php

namespace App\Entity;

use App\Repository\NewsItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsItemRepository::class)]
#[ORM\Table(name: 'news_items')]
class NewsItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private string $image = '';

    #[ORM\Column(length: 80)]
    private string $category = '';

    #[ORM\Column(length: 50)]
    private string $timestamp = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column(type: 'text')]
    private string $excerpt = '';

    #[ORM\Column(length: 20)]
    private string $style = 'card';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getImage(): string { return $this->image; }
    public function setImage(string $v): static { $this->image = $v; return $this; }
    public function getCategory(): string { return $this->category; }
    public function setCategory(string $v): static { $this->category = $v; return $this; }
    public function getTimestamp(): string { return $this->timestamp; }
    public function setTimestamp(string $v): static { $this->timestamp = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getExcerpt(): string { return $this->excerpt; }
    public function setExcerpt(string $v): static { $this->excerpt = $v; return $this; }
    public function getStyle(): string { return $this->style; }
    public function setStyle(string $v): static { $this->style = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['image' => $this->image, 'category' => $this->category, 'timestamp' => $this->timestamp, 'title' => $this->title, 'excerpt' => $this->excerpt, 'style' => $this->style];
    }
}
