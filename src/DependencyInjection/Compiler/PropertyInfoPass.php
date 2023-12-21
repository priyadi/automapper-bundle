<?php

namespace AutoMapper\Bundle\DependencyInjection\Compiler;

use AutoMapper\Extractor\MapToContextPropertyInfoExtractorDecorator;
use AutoMapper\Extractor\PropertyTypeExtractorDecorator;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoCacheExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

class PropertyInfoPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('property_info')) {
            return;
        }

        $container->setDefinition(
            'automapper.property_info.reflection_extractor.inner',
            new Definition(
                ReflectionExtractor::class,
                [
                    '$accessFlags' => ReflectionExtractor::ALLOW_PUBLIC | ReflectionExtractor::ALLOW_PROTECTED | ReflectionExtractor::ALLOW_PRIVATE,
                ]
            )
        );

        $container->setDefinition(
            'automapper.property_info.reflection_extractor',
            new Definition(
                MapToContextPropertyInfoExtractorDecorator::class,
                [
                    new Reference('automapper.property_info.reflection_extractor.inner'),
                ]
            )
        );

        $container->setDefinition(
            'automapper.property_info.property_type_extractor',
            new Definition(
                PropertyTypeExtractorDecorator::class,
                [
                    new Reference('property_info.php_doc_extractor'),
                    new Reference('property_info.reflection_extractor'),
                ]
            )
        );

        $container->setDefinition(
            'automapper.property_info',
            new Definition(
                PropertyInfoExtractor::class,
                [
                    new IteratorArgument([
                        new Reference('automapper.property_info.reflection_extractor'),
                    ]),
                    new IteratorArgument([
                        new Reference('automapper.property_info.property_type_extractor'),
                    ]),
                    new IteratorArgument([
                        new Reference('automapper.property_info.reflection_extractor'),
                    ]),
                    new IteratorArgument([
                        new Reference('automapper.property_info.reflection_extractor'),
                    ]),
                    new IteratorArgument([
                        new Reference('automapper.property_info.reflection_extractor'),
                    ]),
                ]
            )
        );

        $container->setDefinition(
            'automapper.property_info.cache',
            new Definition(PropertyInfoCacheExtractor::class, [
                new Reference('.inner'),
                new Reference('cache.property_info'),
            ])
        )->setDecoratedService('automapper.property_info');
    }
}
