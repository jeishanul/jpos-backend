<?php

namespace App\Repositories;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandRepository extends Repository
{
    private static $path = '/brand';
    public static function model()
    {
        return Brand::class;
    }
    public static function storeByRequest(BrandRequest $brandRequest): Brand
    {
        $mediaId = null;
        if ($brandRequest->hasFile('image')) {
            $media = MediaRepository::storeByRequest(
                $brandRequest->image,
                self::$path,
                'Image'
            );
            $mediaId = $media->id;
        }

        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'name' => $brandRequest->name,
            'status' => $brandRequest->status,
            'media_id' => $mediaId
        ]);
    }
    public static function updateByRequest(BrandRequest $brandRequest, Brand $brand): Brand
    {
        $mediaId = null;
        if ($brandRequest->hasFile('image')) {
            $media = MediaRepository::updateOrCreateByRequest(
                $brandRequest->image,
                self::$path,
                'Image',
                $brand->media
            );
            $mediaId = $media->id;
        }

        self::update($brand, [
            'name' => $brandRequest->name,
            'status' => $brandRequest->status,
            'media_id' => $mediaId ? $mediaId : $brand->media_id
        ]);

        return $brand;
    }
    public static function search($search)
    {
        $brands = self::shop()->brands()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $brands;
    }
}
