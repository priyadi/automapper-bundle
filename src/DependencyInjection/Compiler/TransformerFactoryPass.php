<?php

namespace AutoMapper\Bundle\DependencyInjection\Compiler;

use AutoMapper\Transformer\ChainTransformerFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TransformerFactoryPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(ChainTransformerFactory::class);

        foreach ($this->findAndSortTaggedServices('automapper.transformer_factory', $container) as $factory) {
            $definition->addMethodCall('addTransformerFactory', [$factory]);
        }
    }
}
