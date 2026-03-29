<?php

namespace App\Entity;

use App\Repository\MarketIndexRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarketIndexRepository::class)]
#[ORM\Table(name: 'market_indices')]
class MarketIndex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $name = '';

    #[ORM\Column(length: 30)]
    private string $price = '';

    #[ORM\Column(name: 'change_val', length: 20)]
    private string $changeVal = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column(length: 255)]
    private string $sparkline = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getPrice(): string { return $this->price; }
    public function setPrice(string $v): static { $this->price = $v; return $this; }
    public function getChangeVal(): string { return $this->changeVal; }
    public function setChangeVal(string $v): static { $this->changeVal = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getSparkline(): string { return $this->sparkline; }
    public function setSparkline(string $v): static { $this->sparkline = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'price' => $this->price, 'change' => $this->changeVal, 'bullish' => $this->bullish, 'sparkline' => $this->sparkline];
    }
}
