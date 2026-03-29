<?php

namespace App\Entity;

use App\Repository\EtfCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtfCategoryRepository::class)]
#[ORM\Table(name: 'etf_categories')]
class EtfCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $count = '';

    #[ORM\Column(length: 150)]
    private string $example = '';

    #[ORM\Column(length: 20)]
    private string $ter = '';

    #[ORM\Column(length: 30)]
    private string $aum = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getCount(): string { return $this->count; }
    public function setCount(string $v): static { $this->count = $v; return $this; }
    public function getExample(): string { return $this->example; }
    public function setExample(string $v): static { $this->example = $v; return $this; }
    public function getTer(): string { return $this->ter; }
    public function setTer(string $v): static { $this->ter = $v; return $this; }
    public function getAum(): string { return $this->aum; }
    public function setAum(string $v): static { $this->aum = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'count' => $this->count, 'example' => $this->example, 'ter' => $this->ter, 'aum' => $this->aum];
    }
}
