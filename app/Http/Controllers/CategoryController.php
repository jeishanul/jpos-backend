<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return $this->json('Category List', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryRepository->storeByRequest($request);
        return $this->json('Category successfully saved', [
            'category' => CategoryResource::make($category),
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $this->categoryRepository->updateByRequest($request, $category);
        return $this->json('Category successfully updated', [
            'category' => CategoryResource::make($category),
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return $this->json('Category successfully deleted');
    }

}
