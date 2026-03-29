<?php

namespace App\Entity;

use App\Repository\KonjunkturItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KonjunkturItemRepository::class)]
#[ORM\Table(name: 'konjunktur_items')]
class KonjunkturItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $datetime = '';

    #[ORM\Column(length: 255)]
    private string $title = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getDatetime(): string { return $this->datetime; }
    public function setDatetime(string $v): static { $this->datetime = $v; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): static { $this->title = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['datetime' => $this->datetime, 'title' => $this->title];
    }
}
