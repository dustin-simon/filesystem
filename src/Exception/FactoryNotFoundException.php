<?php

namespace Dustin\Filesystem\Exception;

class FactoryNotFoundException extends FilesystemException
{
    public function __construct(string $type)
    {
        parent::__construct(\sprintf("A factory for filesystem type '%s' was not found.", $type));
    }
}
