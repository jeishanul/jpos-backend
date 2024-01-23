<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = BrandRepository::query()->orderByDesc('id')->get();
        return $this->json('Brand List', [
            'brands' => BrandResource::collection($brands),
        ]);
    }
    public function store(BrandRequest $brandRequest)
    {
        $brand = BrandRepository::storeByRequest($brandRequest);
        return $this->json('Brand successfully created', [
            'brand' => BrandResource::make($brand),
        ]);
    }
    public function details(Brand $brand)
    {
        return $this->json('Brand Details', [
            'brand' => BrandResource::make($brand),
        ]);
    }
    public function update(BrandRequest $brandRequest, Brand $brand)
    {
        BrandRepository::updateByRequest($brandRequest, $brand);
        return back()->with('success', 'Brand successfully updated!');
    }
    public function delete(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Brand is deleted successfully!');
    }
}
