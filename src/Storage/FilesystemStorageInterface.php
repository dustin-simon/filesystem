<?php

namespace Dustin\Filesystem\Storage;

use Dustin\Filesystem\FilesystemConfig;
use Dustin\Filesystem\Identifier;

interface FilesystemStorageInterface
{
    public function get(Identifier $identifier): ?FilesystemConfig;

    public function upsert(FilesystemConfig $config): void;

    public function remove(Identifier $identifier): void;

    public function has(Identifier $identifier): bool;
}
