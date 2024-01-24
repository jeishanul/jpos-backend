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
            "password" => Hash::make($supplierRequest->password),
            "phone_number" => $supplierRequest->phone_number,
            "status" => $supplierRequest->status,
            'media_id' => $mediaId ? $mediaId : $supplier->media_id,
        ]);
        return $supplier;
    }
}
