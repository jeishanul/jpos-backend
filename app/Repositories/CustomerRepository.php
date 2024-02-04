<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Http\Requests\CustomerRequest;
use App\Models\User;

class CustomerRepository extends Repository
{
    public static $path = "/customer";
    /**
     * A description of the entire PHP function.
     *
     * @return User::class
     */
    public static function model()
    {
        return User::class;
    }
    /**
     * Store a new user based on the provided request data.
     *
     * @param CustomerRequest $customerRequest The request data for creating a new user
     * @return User The newly created user
     */
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
            "password" => bcrypt($customerRequest->password),
            "phone_number" => $customerRequest->phone_number,
            "phone_number_verified_at" => now(),
            "role" => Role::CUSTOMER->value,
            "status" => $customerRequest->status,
            "media_id" => $mediaId
        ]);
    }
    /**
     * Update user by request.
     *
     * @param CustomerRequest $customerRequest description
     * @param User $customer description
     * @return User
     */
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
    /**
     * search function.
     *
     * @param mixed $search
     * @return mixed
     */
    public static function search($search)
    {
        $customers = self::shop()->customers()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('email', 'Like', "%{$search}%")
                ->orWhere('phone_number', 'Like', "%{$search}%");
        });

        return $customers;
    }
}
