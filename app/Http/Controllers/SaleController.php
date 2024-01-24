<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Repositories\ProductRepository;
use App\Repositories\SaleProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = SaleRepository::getAll();
        return $this->json('Sale List', [
            'sales' => SaleResource::collection($sales),
        ]);
    }
    public function store(SaleRequest $saleRequest)
    {
        $sale = SaleRepository::storeByRequest($saleRequest);
        $subTotal = 0;
        $paymentStatus = PaymentStatus::PAID->value;

        foreach ($saleRequest->products as $saleProduct) {
            SaleProductRepository::storeByRequest($sale->id, $saleProduct['id'], $saleProduct['qty']);
            $product = ProductRepository::find($saleProduct['id']);
            $tax = $product->price * $product->tax->rate / 100;
            $subTotal += ($product->price + $tax) * $saleProduct['qty'];
        }

        $grandTotal = $subTotal - $saleRequest->order_discount + $saleRequest->shipping_cost;
        if ($grandTotal > $saleRequest->paid_amount) {
            $paymentStatus = PaymentStatus::DUE->value;
        }
        
        $sale->update([
            'grand_total' => $grandTotal,
            'payment_status' => $paymentStatus
        ]);

        return $this->json('Sale successfully created', [
            'sale' => saleResource::make($sale),
        ]);
    }
    public function details(Sale $sale)
    {
        return $this->json('Sale Details', [
            'sale' => SaleResource::make($sale),
        ]);
    }
    public function update(SaleRequest $saleRequest, Sale $sale)
    {
        $sale = SaleRepository::updateByRequest($saleRequest, $sale);
        $sale->saleProducts()->delete();
        $subTotal = 0;
        $paymentStatus = PaymentStatus::PAID->value;

        foreach ($saleRequest->products as $saleProduct) {
            SaleProductRepository::storeByRequest($sale->id, $saleProduct['id'], $saleProduct['qty']);
            $product = ProductRepository::find($saleProduct['id']);
            $tax = $product->price * $product->tax->rate / 100;
            $subTotal += ($product->price + $tax) * $saleProduct['qty'];
        }

        $grandTotal = $subTotal - $saleRequest->order_discount + $saleRequest->shipping_cost;
        if ($grandTotal > $saleRequest->paid_amount) {
            $paymentStatus = PaymentStatus::DUE->value;
        }

        $sale->update([
            'grand_total' => $grandTotal,
            'payment_status' => $paymentStatus
        ]);

        return $this->json('Sale successfully created', [
            'sale' => SaleResource::make($sale),
        ]);
    }
    public function delete(Sale $sale)
    {
        $sale->delete();
        return $this->json('Sale successfully deleted');
    }
}
