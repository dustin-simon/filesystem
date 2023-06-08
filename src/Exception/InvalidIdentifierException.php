<?php

namespace Dustin\Filesystem\Exception;

use Dustin\Filesystem\Identifier;

class InvalidIdentifierException extends FilesystemException
{
    public function __construct(
        private Identifier $identifier,
        ?string $message = null
    ) {
        $m = sprintf('Identifier %s is invalid.', $identifier);

        if ($message !== null) {
            $m .= "\n$message";
        }

        parent::__construct($m);
    }
}
