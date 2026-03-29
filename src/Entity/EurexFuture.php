<?php

namespace App\Entity;

use App\Repository\EurexFutureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EurexFutureRepository::class)]
#[ORM\Table(name: 'eurex_futures')]
class EurexFuture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $expiry = '';

    #[ORM\Column(length: 20)]
    private string $last = '';

    #[ORM\Column(name: 'change_val', length: 20)]
    private string $changeVal = '';

    #[ORM\Column(length: 20)]
    private string $pct = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column(length: 20)]
    private string $volume = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getExpiry(): string { return $this->expiry; }
    public function setExpiry(string $v): static { $this->expiry = $v; return $this; }
    public function getLast(): string { return $this->last; }
    public function setLast(string $v): static { $this->last = $v; return $this; }
    public function getChangeVal(): string { return $this->changeVal; }
    public function setChangeVal(string $v): static { $this->changeVal = $v; return $this; }
    public function getPct(): string { return $this->pct; }
    public function setPct(string $v): static { $this->pct = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getVolume(): string { return $this->volume; }
    public function setVolume(string $v): static { $this->volume = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'expiry' => $this->expiry, 'last' => $this->last, 'change' => $this->changeVal, 'pct' => $this->pct, 'bullish' => $this->bullish, 'volume' => $this->volume];
    }
}
