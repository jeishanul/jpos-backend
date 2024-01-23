<?php

namespace App\Http\Requests;

use App\Enums\BarcodeSymbology;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Enums\TaxMethods;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = request()->isMethod('put');
        $isImageRequired = 'required';
        if ($method) {
            $isImageRequired = 'nullable';
        }
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|numeric|max:255',
            'type' => ['required', new Enum(ProductType::class)],
            'model' => 'nullable|numeric|max:255',
            'barcode_symbology' => ['required', new Enum(BarcodeSymbology::class)],
            'category_id' => 'required|integer',
            'tax_id' => 'required|integer',
            'tax_method' => ['required', new Enum(TaxMethods::class)],
            'brand_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'alert_quantity' => 'required|integer',
            'image' => $isImageRequired . '|mimes:jpg,jpeg,png,gif',
            'status' => ['required', new Enum(Status::class)]
        ];
    }
}
