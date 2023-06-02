<?php

namespace Dustin\Filesystem;

use Dustin\Encapsulation\EncapsulationInterface;
use Dustin\Encapsulation\PropertyEncapsulation;

class Identifier extends PropertyEncapsulation
{
    protected int|string|EncapsulationInterface $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        $id = $this->id ?? null;

        if ($id === null || is_int($id) || is_string($id)) {
            return (string) $id;
        }

        return json_encode($id->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
