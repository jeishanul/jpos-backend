<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryRepository extends Repository
{
    public static $path = '/category';
    /**
     * Retrieve the model for the PHP function.
     *
     * @return string
     */
    public static function model()
    {
        return Category::class;
    }
    /**
     * Store a new category using the provided request data.
     *
     * @param CategoryRequest $categoryRequest The request data for the category
     * @return Category The newly created category
     */
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
    /**
     * Update a category using the provided request data and category model.
     *
     * @param CategoryRequest $categoryRequest The request data for updating the category
     * @param Category $category The category model to be updated
     * @return Category The updated category model
     */
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
    /**
     * Perform a search for categories based on the given criteria.
     *
     * @param mixed $search The search criteria to filter the categories.
     * @return \Illuminate\Database\Eloquent\Collection The collection of categories that match the search criteria.
     */
    public static function categorySearch($search)
    {
        $categories = self::shop()->categories()->whereNull('parent_id')->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $categories;
    }
    /**
     * Perform a search for subcategories based on the given search term.
     *
     * @param mixed $search The search term to filter subcategories.
     * @return \Illuminate\Database\Eloquent\Builder The filtered subcategories.
     */
    public static function subcategorySearch($search)
    {
        $subcategories = self::shop()->categories()->whereNotNull('parent_id')->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $subcategories;
    }
}
