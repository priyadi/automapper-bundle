<?php

namespace AutoMapper\Bundle\Tests\Fixtures;

use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @DiscriminatorMap(typeProperty="type", mapping={
 *    "cat"="AutoMapper\Bundle\Tests\Fixtures\Cat",
 *    "dog"="AutoMapper\Bundle\Tests\Fixtures\Dog"
 * })
 */
class Pet
{
    /** @var string */
    public $type;
}
