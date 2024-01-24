<?php

namespace App\Repositories;

use App\Enums\PaymentStatus;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;

class SaleRepository extends Repository
{
    public static function model()
    {
        return Sale::class;
    }
    public static function storeByRequest(SaleRequest $saleRequest): Sale
    {
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'customer_id' => $saleRequest->customer_id,
            'date' => $saleRequest->date ?? now(),
            'reference_no' => 'ps-' . date("Ymd") . '-' . date("his"),
            'order_discount' => $saleRequest->order_discount,
            'shipping_cost' => $saleRequest->shipping_cost,
            'grand_total' => 0,
            'paid_amount' => $saleRequest->paid_amount,
            'payment_status' => PaymentStatus::UNPAID->value,
            'payment_method' => $saleRequest->payment_method,
            'note' => $saleRequest->note,
        ]);
    }
    public static function updateByRequest(SaleRequest $saleRequest, Sale $sale): Sale
    {
        self::update($sale, [
            'customer_id' => $saleRequest->customer_id,
            'date' => $saleRequest->date ?? now(),
            'reference_no' => 'pr-' . date("Ymd") . '-' . date("his"),
            'order_discount' => $saleRequest->order_discount,
            'shipping_cost' => $saleRequest->shipping_cost,
            'grand_total' => 0,
            'paid_amount' => $saleRequest->paid_amount,
            'payment_status' => PaymentStatus::UNPAID->value,
            'payment_method' => $saleRequest->payment_method,
            'note' => $saleRequest->note,
        ]);

        return $sale;
    }
}
