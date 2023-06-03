<?php

namespace Dustin\Filesystem\Validator;

use Dustin\Encapsulation\EncapsulationInterface;
use Dustin\Filesystem\Exception\InvalidFilesystemConfigException;
use Dustin\Filesystem\FilesystemConfig;
use Dustin\Filesystem\FilesystemRegistry;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FilesystemValidator
{
    public function __construct(
        private FilesystemRegistry $registry,
        private ValidatorInterface $validator
    ) {
    }

    public function validate(FilesystemConfig $config): void
    {
        $violations = $this->getViolations($config);

        if ($violations->count() > 0) {
            throw new InvalidFilesystemConfigException($violations, $config);
        }
    }

    public function validateConfig(string $type, EncapsulationInterface $config): void
    {
        $violations = $this->getConfigViolations($type, $config);

        if ($violations->count() > 0) {
            throw new InvalidFilesystemConfigException($violations, $config);
        }
    }

    public function getViolations(FilesystemConfig $config): ConstraintViolationList
    {
        return $this->validator->validate($config, $this->buildConstraints($config));
    }

    public function getConfigViolations(string $type, EncapsulationInterface $config, ?string $rootPath = null): ConstraintViolationList
    {
        if (!$this->registry->hasFactory($type)) {
            return new ConstraintViolationList();
        }

        $constraints = $this->registry->getFactory($type)->getConstraints();

        if ($rootPath === null) {
            return $this->validator->validate($config, $constraints);
        }

        return $this->validator->startContext()->atPath($rootPath)->validate($config, $constraints)->getViolations();
    }

    protected function buildConstraints(FilesystemConfig $config): array
    {
        $constraints = [
            'identifier' => [new NotBlank()],
            'name' => [new NotBlank()],
            'type' => [new NotBlank()],
        ];

        $type = $config->get('type');
        if ($type !== null && $this->registry->hasFactory($type)) {
            $constraints['config'] = new Collection($this->registry->getFactory($type)->getConstraints());
        }

        return $constraints;
    }
}
