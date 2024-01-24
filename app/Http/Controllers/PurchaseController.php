<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Repositories\PurchaseRepository;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = PurchaseRepository::getAll();
        return $this->json('Purchase List', [
            'purchases' => PurchaseResource::collection($purchases),
        ]);
    }
    public function store(PurchaseRequest $purchaseRequest)
    {
        $purchase = PurchaseRepository::storeByRequest($purchaseRequest);
        return $this->json('Purchase successfully created', [
            'purchase' => PurchaseResource::make($purchase),
        ]);
    }
    public function details(Purchase $purchase)
    {
        return $this->json('Purchase Details', [
            'purchase' => new PurchaseResource($purchase),
        ]);
    }
    public function update(PurchaseRequest $purchaseRequest, Purchase $purchase)
    {
        $purchase = PurchaseRepository::updateByRequest($purchaseRequest, $purchase);
        return $this->json('Purchase successfully created', [
            'purchase' => PurchaseResource::make($purchase),
        ]);
    }
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        return $this->json('Purchase successfully deleted');
    }
}
