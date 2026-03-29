<?php

namespace App\Entity;

use App\Repository\TagesPanelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagesPanelRepository::class)]
#[ORM\Table(name: 'tagestrends_panels')]
class TagesPanel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $tabId = '';

    #[ORM\Column]
    private bool $bullish = true;

    #[ORM\Column(length: 20)]
    private string $high = '';

    #[ORM\Column(length: 20)]
    private string $low = '';

    #[ORM\Column(type: 'text')]
    private string $line = '';

    #[ORM\Column(type: 'json')]
    private array $stocks = [];

    public function getId(): ?int { return $this->id; }
    public function getTabId(): string { return $this->tabId; }
    public function setTabId(string $v): static { $this->tabId = $v; return $this; }
    public function isBullish(): bool { return $this->bullish; }
    public function setBullish(bool $v): static { $this->bullish = $v; return $this; }
    public function getHigh(): string { return $this->high; }
    public function setHigh(string $v): static { $this->high = $v; return $this; }
    public function getLow(): string { return $this->low; }
    public function setLow(string $v): static { $this->low = $v; return $this; }
    public function getLine(): string { return $this->line; }
    public function setLine(string $v): static { $this->line = $v; return $this; }
    public function getStocks(): array { return $this->stocks; }
    public function setStocks(array $v): static { $this->stocks = $v; return $this; }

    public function toArray(): array
    {
        return ['bullish' => $this->bullish, 'high' => $this->high, 'low' => $this->low, 'line' => $this->line, 'stocks' => $this->stocks];
    }
}
