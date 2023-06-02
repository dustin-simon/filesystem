<?php

namespace Dustin\Filesystem\Exception;

class DuplicateFactoryException extends FilesystemException
{
    public function __construct(string $type)
    {
        parent::__construct(\sprintf("A factory for filesystem type '%s' already exists.", $type));
    }
}
