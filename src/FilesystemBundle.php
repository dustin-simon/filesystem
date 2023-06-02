<?php

namespace Dustin\Filesystem;

use Dustin\Filesystem\DependencyInjection\RegistryCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FilesystemBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegistryCompilerPass());

        $loader = new XmlFileLoader($container, new FileLocator());
        $loader->load($this->getPath().'/DependencyInjection/services.xml');
    }
}
