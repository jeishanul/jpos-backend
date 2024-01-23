<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'model' => $this->model,
            'barcode_symbology' => $this->barcode_symbology,
            'category' => CategoryResource::make($this->category),
            'tax' => TaxResource::make($this->tax),
            'tax_method' => $this->tax_method,
            'brand' => BrandResource::make($this->brand),
            'unit' => UnitResource::make($this->unit),
            'media' => $this->media->file,
            'price' => $this->price,
            'cost' => $this->cost,
            'qty' => $this->qty,
            'alert_quantity' => $this->alert_quantity,
            'status' => $this->status,
        ];
    }
}
