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
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchBrands = BrandRepository::search($search);
        $total = $searchBrands->count();
        $brands = $searchBrands->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Brand List', [
            'total' => $total,
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
        $brand = BrandRepository::updateByRequest($brandRequest, $brand);
        return $this->json('Brand successfully updated', [
            'brand' => BrandResource::make($brand),
        ]);
    }
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return $this->json('Brand successfully deleted');
    }
}
