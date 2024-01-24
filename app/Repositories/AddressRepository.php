<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends Repository
{
    public static function model()
    {
        return Address::class;
    }
    public static function storeByRequest($request): Address
    {
        return self::create([]);
    }
    public static function updateByRequest($request, Address $address): Address
    {
        self::update($address, []);
        return $address;
    }
}
