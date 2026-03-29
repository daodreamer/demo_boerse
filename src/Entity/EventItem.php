<?php

namespace App\Entity;

use App\Repository\EventItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventItemRepository::class)]
#[ORM\Table(name: 'event_items')]
class EventItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $date = '';

    #[ORM\Column(length: 150)]
    private string $company = '';

    #[ORM\Column(length: 80)]
    private string $type = '';

    #[ORM\Column]
    private int $sortOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function getDate(): string { return $this->date; }
    public function setDate(string $v): static { $this->date = $v; return $this; }
    public function getCompany(): string { return $this->company; }
    public function setCompany(string $v): static { $this->company = $v; return $this; }
    public function getType(): string { return $this->type; }
    public function setType(string $v): static { $this->type = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['date' => $this->date, 'company' => $this->company, 'type' => $this->type];
    }
}
