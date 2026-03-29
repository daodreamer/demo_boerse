<?php

namespace App\Entity;

use App\Repository\EtfProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtfProductRepository::class)]
#[ORM\Table(name: 'etf_products')]
class EtfProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $isin = '';

    #[ORM\Column(length: 20)]
    private string $price = '';

    #[ORM\Column(name: 'change_val', length: 20)]
    private string $changeVal = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column(length: 20)]
    private string $ytd = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getIsin(): string { return $this->isin; }
    public function setIsin(string $v): static { $this->isin = $v; return $this; }
    public function getPrice(): string { return $this->price; }
    public function setPrice(string $v): static { $this->price = $v; return $this; }
    public function getChangeVal(): string { return $this->changeVal; }
    public function setChangeVal(string $v): static { $this->changeVal = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getYtd(): string { return $this->ytd; }
    public function setYtd(string $v): static { $this->ytd = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'isin' => $this->isin, 'price' => $this->price, 'change' => $this->changeVal, 'bullish' => $this->bullish, 'ytd' => $this->ytd];
    }
}
