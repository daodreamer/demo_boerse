<?php

namespace App\Entity;

use App\Repository\IndizesRowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndizesRowRepository::class)]
#[ORM\Table(name: 'indizes_rows')]
class IndizesRow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $aktuell = '';

    #[ORM\Column(length: 20)]
    private string $pkt = '';

    #[ORM\Column(length: 20)]
    private string $pct = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column(length: 20)]
    private string $high52 = '';

    #[ORM\Column(length: 20)]
    private string $low52 = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getAktuell(): string { return $this->aktuell; }
    public function setAktuell(string $v): static { $this->aktuell = $v; return $this; }
    public function getPkt(): string { return $this->pkt; }
    public function setPkt(string $v): static { $this->pkt = $v; return $this; }
    public function getPct(): string { return $this->pct; }
    public function setPct(string $v): static { $this->pct = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getHigh52(): string { return $this->high52; }
    public function setHigh52(string $v): static { $this->high52 = $v; return $this; }
    public function getLow52(): string { return $this->low52; }
    public function setLow52(string $v): static { $this->low52 = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'aktuell' => $this->aktuell, 'pkt' => $this->pkt, 'pct' => $this->pct, 'bullish' => $this->bullish, 'high52' => $this->high52, 'low52' => $this->low52];
    }
}
