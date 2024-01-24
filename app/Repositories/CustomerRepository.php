<?php

namespace App\Repositories;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerRepository extends Repository
{
    public static $path = "/customer";
    public static function model()
    {
        return User::class;
    }
    public static function storeByRequest(CustomerRequest $customerRequest): User
    {
        $mediaId = null;
        if ($customerRequest->hasFile('image')) {
            $media = MediaRepository::storeByRequest(
                $customerRequest->image,
                self::$path,
                'Image'
            );
            $mediaId = $media->id;
        }

        return self::create([
            "name" => $customerRequest->name,
            "email" => $customerRequest->email,
            "email_verified_at" => now(),
            "password" => Hash::make($customerRequest->password),
            "phone_number" => $customerRequest->phone_number,
            "phone_number_verified_at" => now(),
            "role" => 'Customer',
            "status" => $customerRequest->status,
            "media_id" => $mediaId
        ]);
    }
    public static function updateByRequest(CustomerRequest $customerRequest, User $customer): User
    {
        self::update($customer, []);
        return $customer;
    }
}
