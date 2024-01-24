<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => UserResource::make($this->customer),
            'date' => $this->date,
            'reference_no' => $this->reference_no,
            'order_discount' => $this->order_discount,
            'shipping_cost' => $this->shipping_cost,
            'grand_total' => $this->grand_total,
            'paid_amount' => $this->paid_amount,
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method,
            'note' => $this->note,
            'sale_products' => SaleProductResource::collection($this->saleProducts),
        ];
    }
}
