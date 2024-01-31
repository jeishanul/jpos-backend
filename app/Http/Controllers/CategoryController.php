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
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchCategories = CategoryRepository::categorySearch($search);
        $total = $searchCategories->count();
        $categories = $searchCategories->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Category List', [
            'total' => $total,
            'categories' => CategoryResource::collection($categories),
        ]);
    }
    public function subcategory()
    {
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchSubCategories = CategoryRepository::subcategorySearch($search);
        $total = $searchSubCategories->count();
        $subcategories = $searchSubCategories->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('subcategory List', [
            'total' => $total,
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
        return $this->json('Category Details', [
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
