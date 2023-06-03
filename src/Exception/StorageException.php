<?php

namespace Dustin\Filesystem\Exception;

class StorageException extends FilesystemException
{
    public static function alreadySet(): self
    {
        return new static('Cannot overwrite filesystem storage. Filesystem registry can only have one storage.');
    }

    public static function notAvailable(): self
    {
        return new static('No filesystem storage available.');
    }
}
