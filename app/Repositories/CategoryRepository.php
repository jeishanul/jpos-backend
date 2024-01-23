<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryRepository extends Repository
{
    public static $path = '/category';

    public static function model()
    {
        return Category::class;
    }
    public static function storeByRequest(CategoryRequest $categoryRequest): Category
    {
        $mediaId = null;
        if ($categoryRequest->hasFile('image')) {
            $media = MediaRepository::storeByRequest(
                $categoryRequest->image,
                self::$path,
                'Image'
            );
            $mediaId = $media->id;
        }

        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'name' => $categoryRequest->name,
            'status' => $categoryRequest->status,
            'parent_id' => $categoryRequest->parent_id,
            'media_id' => $mediaId,
        ]);
    }
    public static function updateByRequest(CategoryRequest $categoryRequest, Category $category): Category
    {
        $mediaId = null;
        if ($categoryRequest->hasFile('image')) {
            $media = MediaRepository::updateOrCreateByRequest(
                $categoryRequest->image,
                self::$path,
                'Image',
                $category->media
            );
            $mediaId = $media->id;
        }

        self::update($category, [
            'name' => $categoryRequest->name,
            'parent_id' => $categoryRequest->parent_id,
            'status' => $categoryRequest->status,
            'media_id' => $mediaId ? $mediaId : $category->media_id,
        ]);
        return $category;
    }
}
