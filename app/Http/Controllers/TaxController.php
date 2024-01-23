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
        $taxs = TaxRepository::getAll();
        return $this->json('Tax List', [
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
    public function delete(Tax $tax)
    {
        $tax->delete();
        return $this->json('Tax successfully deleted');
    }
}
