<?php

namespace App\Repositories;

use App\Enums\Role;
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
            "role" => Role::CUSTOMER->value,
            "status" => $customerRequest->status,
            "media_id" => $mediaId
        ]);
    }
    public static function updateByRequest(CustomerRequest $customerRequest, User $customer): User
    {
        $mediaId = null;
        if ($customerRequest->hasFile('image')) {
            $media = MediaRepository::updateOrCreateByRequest(
                $customerRequest->image,
                self::$path,
                'Image',
                $customer->media
            );
            $mediaId = $media->id;
        }

        self::update($customer, [
            "name" => $customerRequest->name,
            "email" => $customerRequest->email,
            "phone_number" => $customerRequest->phone_number,
            "status" => $customerRequest->status,
            'media_id' => $mediaId ? $mediaId : $customer->media_id,
        ]);
        return $customer;
    }
}
