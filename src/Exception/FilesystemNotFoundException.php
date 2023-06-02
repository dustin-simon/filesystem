<?php

namespace Dustin\Filesystem\Exception;

use Dustin\Filesystem\Identifier;

class FilesystemNotFoundException extends FilesystemException
{
    /**
     * @var Identifier
     */
    private $identifier;

    public function __construct(Identifier $identifier)
    {
        $this->identifier = $identifier;

        parent::__construct(sprintf("Filesystem for identifier '%s' was not found.", $identifier));
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }
}
