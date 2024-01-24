<?php

namespace App\Repositories;

use App\Http\Requests\SupplierRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SupplierRepository extends Repository
{
    public static $path = "/supplier";
    public static function model()
    {
        return User::class;
    }
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
            "password" => Hash::make($supplierRequest->password),
            "phone_number" => $supplierRequest->phone_number,
            "phone_number_verified_at" => now(),
            "role" => 'Customer',
            "status" => $supplierRequest->status,
            "media_id" => $mediaId
        ]);
    }
    public static function updateByRequest(SupplierRequest $supplierRequest, User $supplier): User
    {
        self::update($supplier, []);
        return $supplier;
    }
}
