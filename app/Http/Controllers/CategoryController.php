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
        $categories = CategoryRepository::getAll();
        return $this->json('Category List', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
    public function store(CategoryRequest $request)
    {
        $category = CategoryRepository::storeByRequest($request);
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
    public function update(CategoryRequest $request, Category $category)
    {
        $category = CategoryRepository::updateByRequest($request, $category);
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
