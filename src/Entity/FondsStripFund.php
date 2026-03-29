<?php

namespace App\Entity;

use App\Repository\FondsStripFundRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FondsStripFundRepository::class)]
#[ORM\Table(name: 'fonds_strip_funds')]
class FondsStripFund
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $thesPrice = '';

    #[ORM\Column(length: 20)]
    private string $thesChange = '';

    #[ORM\Column]
    private bool $thesBullish = true;

    #[ORM\Column(length: 20)]
    private string $ausshPrice = '';

    #[ORM\Column(length: 20)]
    private string $ausshChange = '';

    #[ORM\Column]
    private bool $ausshBullish = true;

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getThesPrice(): string { return $this->thesPrice; }
    public function setThesPrice(string $v): static { $this->thesPrice = $v; return $this; }
    public function getThesChange(): string { return $this->thesChange; }
    public function setThesChange(string $v): static { $this->thesChange = $v; return $this; }
    public function isThesBullish(): bool { return $this->thesBullish; }
    public function setThesBullish(bool $v): static { $this->thesBullish = $v; return $this; }
    public function getAusshPrice(): string { return $this->ausshPrice; }
    public function setAusshPrice(string $v): static { $this->ausshPrice = $v; return $this; }
    public function getAusshChange(): string { return $this->ausshChange; }
    public function setAusshChange(string $v): static { $this->ausshChange = $v; return $this; }
    public function isAusshBullish(): bool { return $this->ausshBullish; }
    public function setAusshBullish(bool $v): static { $this->ausshBullish = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'thes'  => ['price' => $this->thesPrice,  'change' => $this->thesChange,  'bullish' => $this->thesBullish],
            'aussh' => ['price' => $this->ausshPrice, 'change' => $this->ausshChange, 'bullish' => $this->ausshBullish],
        ];
    }
}
