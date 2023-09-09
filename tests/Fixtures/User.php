<?php

namespace AutoMapper\Bundle\Tests\Fixtures;

class User extends BaseUser
{
    /**
     * @var AddressDTO
     */
    public $address;

    /**
     * @var AddressDTO[]
     */
    public $addresses = [];
}
