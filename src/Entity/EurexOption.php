<?php

namespace App\Entity;

use App\Repository\EurexOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EurexOptionRepository::class)]
#[ORM\Table(name: 'eurex_options')]
class EurexOption
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

    #[ORM\Column(length: 20)]
    private string $iv = '';

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
    public function getIv(): string { return $this->iv; }
    public function setIv(string $v): static { $this->iv = $v; return $this; }
    public function getVolume(): string { return $this->volume; }
    public function setVolume(string $v): static { $this->volume = $v; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $v): static { $this->sortOrder = $v; return $this; }

    public function toArray(): array
    {
        return ['name' => $this->name, 'expiry' => $this->expiry, 'last' => $this->last, 'iv' => $this->iv, 'volume' => $this->volume];
    }
}
