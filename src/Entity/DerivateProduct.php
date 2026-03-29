<?php

namespace App\Entity;

use App\Repository\DerivateProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DerivateProductRepository::class)]
#[ORM\Table(name: 'derivate_products')]
class DerivateProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private string $name = '';

    #[ORM\Column(length: 80)]
    private string $issuer = '';

    #[ORM\Column(length: 20)]
    private string $bid = '';

    #[ORM\Column(length: 20)]
    private string $ask = '';

    #[ORM\Column(name: 'change_val', length: 20)]
    private string $changeVal = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getIssuer(): string { return $this->issuer; }
    public function setIssuer(string $v): static { $this->issuer = $v; return $this; }
    public function getBid(): string { return $this->bid; }
    public function setBid(string $v): static { $this->bid = $v; return $this; }
    public function getAsk(): string { return $this->ask; }
    public function setAsk(string $v): static { $this->ask = $v; return $this; }
    public function getChangeVal(): string { return $this->changeVal; }
    public function setChangeVal(string $v): static { $this->changeVal = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'issuer' => $this->issuer, 'bid' => $this->bid, 'ask' => $this->ask, 'change' => $this->changeVal, 'bullish' => $this->bullish];
    }
}
