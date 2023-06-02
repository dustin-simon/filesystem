<?php

namespace Dustin\Filesystem\Storage;

use Dustin\Filesystem\FilesystemConfig;
use Dustin\Filesystem\Identifier;

interface FilesystemStorageInterface
{
    public function getConfig(Identifier $identifier): ?FilesystemConfig;

    public function upsert(FilesystemConfig $config): void;

    public function delete(Identifier $identifier): void;
}
