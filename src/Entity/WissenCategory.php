<?php

namespace App\Entity;

use App\Repository\WissenCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WissenCategoryRepository::class)]
#[ORM\Table(name: 'wissen_categories')]
class WissenCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $title = '';

    #[ORM\Column(length: 50)]
    private string $icon = '';

    #[ORM\Column(type: 'json')]
    private array $articles = [];

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getIcon(): string { return $this->icon; }
    public function setIcon(string $v): static { $this->icon = $v; return $this; }
    public function getArticles(): array { return $this->articles; }
    public function setArticles(array $v): static { $this->articles = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['title' => $this->title, 'icon' => $this->icon, 'articles' => $this->articles];
    }
}
