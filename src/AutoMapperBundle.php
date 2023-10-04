<?php

namespace AutoMapper\Bundle;

use AutoMapper\Bundle\DependencyInjection\AutoMapperExtension;
use AutoMapper\Bundle\DependencyInjection\Compiler\MapperConfigurationPass;
use AutoMapper\Bundle\DependencyInjection\Compiler\PropertyInfoPass;
use AutoMapper\Bundle\DependencyInjection\Compiler\TransformerFactoryPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AutoMapperBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new MapperConfigurationPass());
        $container->addCompilerPass(new PropertyInfoPass());
        $container->addCompilerPass(new TransformerFactoryPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new AutoMapperExtension();
    }
}
