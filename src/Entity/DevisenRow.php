<?php

namespace App\Entity;

use App\Repository\DevisenRowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisenRowRepository::class)]
#[ORM\Table(name: 'devisen_rows')]
class DevisenRow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $pair = '';

    #[ORM\Column(length: 20)]
    private string $kurs = '';

    #[ORM\Column(length: 20)]
    private string $pct = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getPair(): string { return $this->pair; }
    public function setPair(string $v): static { $this->pair = $v; return $this; }
    public function getKurs(): string { return $this->kurs; }
    public function setKurs(string $v): static { $this->kurs = $v; return $this; }
    public function getPct(): string { return $this->pct; }
    public function setPct(string $v): static { $this->pct = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['pair' => $this->pair, 'kurs' => $this->kurs, 'pct' => $this->pct, 'bullish' => $this->bullish];
    }
}
