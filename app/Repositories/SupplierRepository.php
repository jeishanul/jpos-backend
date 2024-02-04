<?php

namespace App\Repositories;

use App\Http\Requests\SupplierRequest;
use App\Models\User;

class SupplierRepository extends Repository
{
    public static $path = "/supplier";
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
     * Store a new user based on the given SupplierRequest.
     *
     * @param SupplierRequest $supplierRequest The request containing user information
     * @return User The newly created user
     */
    public static function storeByRequest(SupplierRequest $supplierRequest): User
    {
        $mediaId = null;
        if ($supplierRequest->hasFile('image')) {
            $media = MediaRepository::storeByRequest(
                $supplierRequest->image,
                self::$path,
                'Image'
            );
            $mediaId = $media->id;
        }

        return self::create([
            "name" => $supplierRequest->name,
            "email" => $supplierRequest->email,
            "email_verified_at" => now(),
            "password" => bcrypt($supplierRequest->password),
            "phone_number" => $supplierRequest->phone_number,
            "phone_number_verified_at" => now(),
            "role" => 'Customer',
            "status" => $supplierRequest->status,
            "media_id" => $mediaId
        ]);
    }
    /**
     * Update user by supplier request.
     *
     * @param SupplierRequest $supplierRequest The supplier request instance
     * @param User $supplier The supplier user instance
     * @return User The updated user instance
     */
    public static function updateByRequest(SupplierRequest $supplierRequest, User $supplier): User
    {
        $mediaId = null;
        if ($supplierRequest->hasFile('image')) {
            $media = MediaRepository::updateOrCreateByRequest(
                $supplierRequest->image,
                self::$path,
                'Image',
                $supplier->media
            );
            $mediaId = $media->id;
        }

        self::update($supplier, [
            "name" => $supplierRequest->name,
            "email" => $supplierRequest->email,
            "phone_number" => $supplierRequest->phone_number,
            "status" => $supplierRequest->status,
            'media_id' => $mediaId ? $mediaId : $supplier->media_id,
        ]);
        return $supplier;
    }
    /**
     * Search for suppliers based on the given search criteria.
     *
     * @param mixed $search The search criteria
     * @return mixed The list of suppliers matching the search criteria
     */
    public static function search($search)
    {
        $suppliers = self::shop()->suppliers()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('email', 'Like', "%{$search}%")
                ->orWhere('phone_number', 'Like', "%{$search}%");
        });

        return $suppliers;
    }
}
