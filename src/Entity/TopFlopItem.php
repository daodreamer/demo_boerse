<?php

namespace App\Entity;

use App\Repository\TopFlopItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopFlopItemRepository::class)]
#[ORM\Table(name: 'tops_flops')]
class TopFlopItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name = '';

    #[ORM\Column(name: 'change_val', length: 20)]
    private string $changeVal = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sparkline = null;

    #[ORM\Column(length: 10)]
    private string $type = 'top';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $v): static { $this->name = $v; return $this; }
    public function getChangeVal(): string { return $this->changeVal; }
    public function setChangeVal(string $v): static { $this->changeVal = $v; return $this; }
    public function getSparkline(): ?string { return $this->sparkline; }
    public function setSparkline(?string $v): static { $this->sparkline = $v; return $this; }
    public function getType(): string { return $this->type; }
    public function setType(string $v): static { $this->type = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'change' => $this->changeVal, 'sparkline' => $this->sparkline];
    }
}
