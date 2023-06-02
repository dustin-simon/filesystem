<?php

namespace Dustin\Filesystem;

use Dustin\Filesystem\Exception\DuplicateFactoryException;
use Dustin\Filesystem\Exception\FactoryNotFoundException;
use Dustin\Filesystem\Exception\FilesystemNotFoundException;
use Dustin\Filesystem\Exception\StorageException;
use Dustin\Filesystem\Factory\FilesystemFactoryInterface;
use Dustin\Filesystem\Storage\FilesystemStorageInterface;
use League\Flysystem\FilesystemOperator;

class FilesystemRegistry
{
    /**
     * @var array
     */
    private $factories = [];

    /**
     * @var FilesystemStorageInterface
     */
    private $storage = null;

    public function setStorage(FilesystemStorageInterface $storage): void
    {
        if ($this->storage !== null) {
            throw StorageException::alreadySet();
        }

        $this->storage = $storage;
    }

    public function addFactory(FilesystemFactoryInterface $factory): void
    {
        $type = $factory->getType();

        if (isset($this->factories[$type])) {
            throw new DuplicateFactoryException($type);
        }

        $this->factories[$type] = $factory;
    }

    public function getFactory(string $type): FilesystemFactoryInterface
    {
        if (!isset($this->factories[$type])) {
            throw new FactoryNotFoundException($type);
        }

        return $this->factories[$type];
    }

    public function hasFactory(string $type): bool
    {
        return isset($this->factories[$type]);
    }

    public function getFilesystem(Identifier $identifier): FilesystemOperator
    {
        $config = $this->getStorage()->getConfig($identifier);

        if ($config === null) {
            throw new FilesystemNotFoundException($identifier);
        }

        return $this->getFactory($config->getType())->createFilesystem($config);
    }

    private function getStorage(): FilesystemStorageInterface
    {
        if ($this->storage === null) {
            throw StorageException::notAvailable();
        }

        return $this->storage;
    }
}
