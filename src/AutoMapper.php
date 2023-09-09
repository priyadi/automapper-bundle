<?php

namespace AutoMapper\Bundle;

use AutoMapper\AutoMapper as BaseAutoMapper;
use AutoMapper\Bundle\Configuration\MapperConfigurationInterface;

class AutoMapper extends BaseAutoMapper
{
    public function addMapperConfiguration(MapperConfigurationInterface $mapperConfiguration): void
    {
        $metadata = $this->getMetadata($mapperConfiguration->getSource(), $mapperConfiguration->getTarget());
        $mapperConfiguration->process($metadata);
    }
}
