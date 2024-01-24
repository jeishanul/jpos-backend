<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends Repository
{
    public static function model()
    {
        return Address::class;
    }
    public static function storeByRequest($request, $user): Address
    {
        return self::create([
            'user_id' => $user->id,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code
        ]);
    }
    public static function updateByRequest($request, $user): Address
    {
        self::update($user->address, [
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code
        ]);
        return $user->address;
    }
}
