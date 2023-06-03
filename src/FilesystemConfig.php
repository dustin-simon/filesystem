<?php

namespace Dustin\Filesystem;

use Dustin\Encapsulation\EncapsulationInterface;
use Dustin\Encapsulation\PropertyEncapsulation;

class FilesystemConfig extends PropertyEncapsulation
{
    protected Identifier $identifier;

    protected string $name;

    protected string $type;

    protected EncapsulationInterface $config;

    public function getIdentifier(): ?Identifier
    {
        return $this->identifier ?? null;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): ?string
    {
        return $this->type ?? null;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getConfig(): ?EncapsulationInterface
    {
        return $this->config ?? null;
    }

    public function setConfig(EncapsulationInterface $config): void
    {
        $this->config = $config;
    }
}
