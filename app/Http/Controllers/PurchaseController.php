<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseProductRepository;
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
        $subTotal = 0;
        $paymentStatus = PaymentStatus::PAID->value;

        foreach ($purchaseRequest->products as $purchaseProduct) {
            PurchaseProductRepository::storeByRequest($purchase->id, $purchaseProduct['id'], $purchaseProduct['qty']);
            $product = ProductRepository::find($purchaseProduct['id']);
            $tax = $product->price * $product->tax->rate / 100;
            $subTotal += ($product->price + $tax) * $purchaseProduct['qty'];
        }

        $grandTotal = $subTotal - $purchaseRequest->order_discount + $purchaseRequest->shipping_cost;
        if ($grandTotal > $purchaseRequest->paid_amount) {
            $paymentStatus = PaymentStatus::DUE->value;
        }
        $purchase->update([
            'grand_total' => $grandTotal,
            'payment_status' => $paymentStatus
        ]);

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
