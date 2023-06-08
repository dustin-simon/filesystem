<?php

namespace Dustin\Filesystem\Factory;

use Dustin\Filesystem\FilesystemConfig;
use League\Flysystem\FilesystemOperator;
use Symfony\Validator\Constraint;

interface FilesystemFactoryInterface
{
    public function getType(): string;

    public function createFilesystem(FilesystemConfig $config): FilesystemOperator;

    /**
     * @return array<string, array<int, Constraint>>
     */
    public function getConstraints(): array;
}
