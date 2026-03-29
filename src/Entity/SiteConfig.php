<?php

namespace App\Entity;

use App\Repository\SiteConfigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiteConfigRepository::class)]
#[ORM\Table(name: 'site_config')]
class SiteConfig
{
    #[ORM\Id]
    #[ORM\Column(length: 80)]
    private string $configKey = '';

    #[ORM\Column(type: 'json')]
    private mixed $value = null;

    public function getConfigKey(): string { return $this->configKey; }
    public function setConfigKey(string $v): static { $this->configKey = $v; return $this; }
    public function getValue(): mixed { return $this->value; }
    public function setValue(mixed $v): static { $this->value = $v; return $this; }
}
