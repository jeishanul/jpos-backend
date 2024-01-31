<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use App\Http\Resources\TaxResource;
use App\Models\Tax;
use App\Repositories\TaxRepository;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchTaxs = TaxRepository::search($search);
        $total = $searchTaxs->count();
        $taxs = $searchTaxs->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Tax List', [
            'total' => $total,
            'taxs' => TaxResource::collection($taxs),
        ]);
    }
    public function store(TaxRequest $taxRequest)
    {
        $tax = TaxRepository::storeByRequest($taxRequest);
        return $this->json('Tax successfully created', [
            'tax' => TaxResource::make($tax),
        ]);
    }
    public function details(Tax $tax)
    {
        return $this->json('Tax Details', [
            'tax' => TaxResource::make($tax),
        ]);
    }
    public function update(TaxRequest $taxRequest, Tax $tax)
    {
        $tax = TaxRepository::updateByRequest($taxRequest, $tax);
        return $this->json('Tax successfully updated', [
            'tax' => TaxResource::make($tax),
        ]);
    }
    public function destroy(Tax $tax)
    {
        $tax->delete();
        return $this->json('Tax successfully deleted');
    }
}
