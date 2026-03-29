<?php

namespace App\Entity;

use App\Repository\DerivateCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DerivateCategoryRepository::class)]
#[ORM\Table(name: 'derivate_categories')]
class DerivateCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private string $name = '';

    #[ORM\Column(length: 50)]
    private string $icon = '';

    #[ORM\Column(type: 'text')]
    private string $description = '';

    #[ORM\Column(length: 20)]
    private string $count = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getIcon(): string { return $this->icon; }
    public function setIcon(string $v): static { $this->icon = $v; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $v): static { $this->description = $v; return $this; }
    public function getCount(): string { return $this->count; }
    public function setCount(string $v): static { $this->count = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'icon' => $this->icon, 'description' => $this->description, 'count' => $this->count];
    }
}
