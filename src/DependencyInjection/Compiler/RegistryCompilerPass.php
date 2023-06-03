<?php

namespace Dustin\Filesystem\DependencyInjection\Compiler;

use Dustin\Filesystem\FilesystemRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class RegistryCompilerPass implements CompilerPassInterface
{
    public const TAG_STORAGE = 'dustin.filesystem.storage';

    public const TAG_FACTORY = 'dustin.filesystem.factory';

    public function process(ContainerBuilder $container): void
    {
        $registryDefinition = $container->findDefinition(FilesystemRegistry::class);

        $this->processStorages($container, $registryDefinition);
        $this->processFactories($container, $registryDefinition);
    }

    public function processStorages(ContainerBuilder $container, Definition $registryDefinition): void
    {
        $taggedStorages = $container->findTaggedServiceIds(self::TAG_STORAGE);

        foreach ($taggedStorages as $storageId => $tags) {
            foreach ((array) $tags as $config) {
                $registryDefinition->addMethodCall('setStorage', [new Reference($storageId)]);
            }
        }
    }

    public function processFactories(ContainerBuilder $container, Definition $registryDefinition): void
    {
        $taggedFactories = $container->findTaggedServiceIds(self::TAG_FACTORY);

        foreach ($taggedFactories as $factoryId => $tags) {
            foreach ((array) $tags as $config) {
                $registryDefinition->addMethodCall('addFactory', [new Reference($factoryId)]);
            }
        }
    }
}
