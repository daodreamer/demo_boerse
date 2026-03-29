<?php

namespace App\Entity;

use App\Repository\FondsCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FondsCategoryRepository::class)]
#[ORM\Table(name: 'fonds_categories')]
class FondsCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $count = '';

    #[ORM\Column(length: 100)]
    private string $topPerformer = '';

    #[ORM\Column(length: 20)]
    private string $ytd = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getCount(): string { return $this->count; }
    public function setCount(string $v): static { $this->count = $v; return $this; }
    public function getTopPerformer(): string { return $this->topPerformer; }
    public function setTopPerformer(string $v): static { $this->topPerformer = $v; return $this; }
    public function getYtd(): string { return $this->ytd; }
    public function setYtd(string $v): static { $this->ytd = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'count' => $this->count, 'topPerformer' => $this->topPerformer, 'ytd' => $this->ytd, 'bullish' => $this->bullish];
    }
}
