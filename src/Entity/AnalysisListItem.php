<?php

namespace App\Entity;

use App\Repository\AnalysisListItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalysisListItemRepository::class)]
#[ORM\Table(name: 'analyses_list')]
class AnalysisListItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $time = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getTime(): string { return $this->time; }
    public function setTime(string $v): static { $this->time = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['time' => $this->time, 'title' => $this->title];
    }
}
