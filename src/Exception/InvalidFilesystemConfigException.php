<?php

namespace Dustin\Filesystem\Exception;

use Dustin\Encapsulation\EncapsulationInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationList;

class InvalidFilesystemConfigException extends HttpException
{
    public function __construct(
        private ConstraintViolationList $violations,
        private EncapsulationInterface $config
    ) {
        parent::__construct(Response::HTTP_BAD_REQUEST, sprintf('Configuration is invalid. Caught %s errors.', count($violations)));
    }

    public function getViolations(?string $propertyPath = null): ConstraintViolationList
    {
        if ($propertyPath === null) {
            return $this->violations;
        }

        $violations = new ConstraintViolationList();
        foreach ($this->violations as $violation) {
            if ($violation->getPropertyPath() === $propertyPath) {
                $violations->add($violation);
            }
        }

        return $violations;
    }

    public function getConfig(): EncapsulationInterface
    {
        return $this->config;
    }
}
