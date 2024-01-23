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
        $thumbnailId = null;
        if ($categoryRequest->hasFile('image')) {
            $thumbnail = MediaRepository::storeByRequest(
                $categoryRequest->image,
                self::$path,
                'Image'
            );
            $thumbnailId = $thumbnail->id;
        }

        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'name' => $categoryRequest->name,
            'parent_id' => $categoryRequest->parent_id,
            'thumbnail_id' => $thumbnailId,
        ]);
    }
    public static function updateByRequest(CategoryRequest $categoryRequest, Category $category): Category
    {
        $thumbnailId = null;
        if ($categoryRequest->hasFile('image')) {
            $thumbnail = MediaRepository::updateOrCreateByRequest(
                $categoryRequest->image,
                self::$path,
                'Image',
                $category->thumbnail
            );
            $thumbnailId = $thumbnail->id;
        }

        self::update($category, [
            'name' => $categoryRequest->name,
            'parent_id' => $categoryRequest->parent_id,
            'thumbnail_id' => $thumbnailId ? $thumbnailId : $category->thumbnail_id,
        ]);
        return $category;
    }
}
