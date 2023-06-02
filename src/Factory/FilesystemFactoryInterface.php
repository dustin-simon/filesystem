<?php

namespace Dustin\Filesystem\Factory;

use Dustin\Filesystem\FilesystemConfig;
use League\Flysystem\FilesystemOperator;

interface FilesystemFactoryInterface
{
    public function getType(): string;

    public function createFilesystem(FilesystemConfig $config): FilesystemOperator;
}
