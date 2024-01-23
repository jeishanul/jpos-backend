<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryRepository::query()->whereNull('parent_id')->get();
        return $this->json('Category List', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
    public function subcategory()
    {
        $subcategories = CategoryRepository::query()->whereNotNull('parent_id')->get();
        return $this->json('subcategory List', [
            'subcategories' => CategoryResource::collection($subcategories),
        ]);
    }
    public function store(CategoryRequest $categoryRequest)
    {
        $category = CategoryRepository::storeByRequest($categoryRequest);
        return $this->json('Category successfully created', [
            'category' => CategoryResource::make($category),
        ]);
    }
    public function details(Category $category)
    {
        return $this->json('Category successfully updated', [
            'category' => CategoryResource::make($category),
        ]);
    }
    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        $category = CategoryRepository::updateByRequest($categoryRequest, $category);
        return $this->json('Category successfully updated', [
            'category' => CategoryResource::make($category),
        ]);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->json('Category successfully deleted');
    }
}
