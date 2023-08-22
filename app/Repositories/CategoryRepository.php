<?php

namespace App\Repositories;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryRepository extends Repository
{
    private $path = '/category';

    public function model()
    {
        return Category::class;
    }

    public function storeByRequest(CategoryStoreRequest $request)
    {
        $mediaId = null;
        if ($request->hasFile('image')) {
            $media = (new MediaRepository())->storeByRequest(
                $request->image,
                $this->path,
                'Image'
            );
            $mediaId = $media->id;
        }

        return $this->create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'media_id' => $mediaId,
            'status' => $request->status,
        ]);
    }

    public function updateByRequest(CategoryUpdateRequest $request, Category $category)
    {
        $mediaId = null;
        if ($request->hasFile('image')) {
            $media = (new MediaRepository())->updateByRequest(
                $request->image,
                $this->path,
                'Image',
                $category->media
            );
            $mediaId = $media->id;
        }
        
        return $this->update($category, [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'media_id' => $mediaId ? $mediaId : $category->media_id,
            'status' => $request->status,
        ]);
    }
}
