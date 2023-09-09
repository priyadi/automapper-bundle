<?php

namespace AutoMapper\Bundle\Configuration;

use AutoMapper\MapperGeneratorMetadataInterface;

interface MapperConfigurationInterface
{
    public function process(MapperGeneratorMetadataInterface $metadata): void;

    public function getSource(): string;

    public function getTarget(): string;
}
