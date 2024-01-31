<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return Address::class
     */
    public static function model()
    {
        return Address::class;
    }
    /**
     * Store a new address based on the request data.
     *
     * @param Request $request The request object containing address data
     * @param User $user The user object for whom the address is being stored
     * @return Address The newly created address
     */
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
    /**
     * Update the user's address based on the given request data.
     *
     * @param datatype $request description
     * @param datatype $user description
     * @return Address
     */
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
