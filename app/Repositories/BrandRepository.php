<?php

namespace App\Repositories;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandRepository extends Repository
{
    private static $path = '/brand';
    /**
     * A description of the entire PHP function.
     *
     * @return Brand::class
     */
    public static function model()
    {
        return Brand::class;
    }
    /**
     * Store a brand by request.
     *
     * @param BrandRequest $brandRequest The brand request object.
     * @throws Some_Exception_Class Description of exception.
     * @return Brand The created brand object.
     */
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
    /**
     * Update a brand using the provided request and brand instance.
     *
     * @param BrandRequest $brandRequest The request data for updating the brand
     * @param Brand $brand The brand instance to be updated
     * @return Brand The updated brand instance
     */
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
    /**
     * Search for brands based on the given search keyword.
     *
     * @param mixed $search The keyword to search for
     * @return mixed The collection of brands matching the search keyword
     */
    public static function search($search)
    {
        $brands = self::shop()->brands()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $brands;
    }
}
