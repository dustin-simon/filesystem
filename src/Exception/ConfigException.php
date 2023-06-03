<?php

namespace Dustin\Filesystem\Exception;

class ConfigException extends FilesystemException
{
    public static function incomplete(): self
    {
        return new self('Filesystem config is incomplete.');
    }
}
