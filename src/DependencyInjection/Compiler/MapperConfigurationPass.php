<?php

namespace AutoMapper\Bundle\DependencyInjection\Compiler;

use AutoMapper\Bundle\AutoMapper;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MapperConfigurationPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        $autoMapper = $container->getDefinition(AutoMapper::class);

        foreach ($this->findAndSortTaggedServices('automapper.mapper_configuration', $container) as $mapperConfiguration) {
            $autoMapper->addMethodCall('addMapperConfiguration', [$mapperConfiguration]);
        }
    }
}
