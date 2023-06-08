<?php

namespace Dustin\Filesystem\Storage;

use Dustin\Filesystem\FilesystemConfig;
use Dustin\Filesystem\Identifier;
use Dustin\Filesystem\Validator\FilesystemValidator;

abstract class FilesystemStorage implements FilesystemStorageInterface
{
    public function __construct(
        protected ?FilesystemValidator $validator
    ) {
    }

    abstract protected function validateIdentifier(Identifier $identifier): void;

    abstract protected function create(FilesystemConfig $config): void;

    abstract protected function read(Identifier $identifier): ?FilesystemConfig;

    abstract protected function update(FilesystemConfig $config): void;

    abstract protected function delete(Identifier $identifier): void;

    public function upsert(FilesystemConfig $config): void
    {
        $this->validator->validate($config);
        $this->validateIdentifier($config->getIdentifier());

        if ($this->has($config->getIdentifier())) {
            $this->update($config);

            return;
        }

        $this->create($config);
    }

    public function get(Identifier $identifier): ?FilesystemConfig
    {
        $this->validateIdentifier($identifier);

        return $this->read($identifier);
    }

    public function remove(Identifier $identifier): void
    {
        $this->validateIdentifier($identifier);

        $this->delete($identifier);
    }
}
