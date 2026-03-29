<?php

namespace App\Entity;

use App\Repository\TagesTabRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagesTabRepository::class)]
#[ORM\Table(name: 'tagestrends_tabs')]
class TagesTab
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $rowIndex = 0;

    #[ORM\Column(length: 30)]
    private string $tabId = '';

    #[ORM\Column(length: 80)]
    private string $label = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getRowIndex(): int { return $this->rowIndex; }
    public function setRowIndex(int $v): static { $this->rowIndex = $v; return $this; }
    public function getTabId(): string { return $this->tabId; }
    public function setTabId(string $v): static { $this->tabId = $v; return $this; }
    public function getLabel(): string { return $this->label; }
    public function setLabel(string $v): static { $this->label = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }
}
