<?php

namespace App\Http\Requests;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\PurchaseStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PurchaseRequest extends FormRequest
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
        return [
            'products' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $item) {
                        if (!is_array($item) || !array_key_exists('id', $item) || !array_key_exists('qty', $item)) {
                            $fail($attribute . ' must be a valid array structure.');
                            return;
                        }
                    }
                },
            ],
            'supplier_id' => 'required|integer',
            'date' => 'nullable|date',
            'order_discount' => 'nullable|numeric',
            'shipping_cost' => 'nullable|numeric',
            'paid_amount' => 'nullable|numeric',
            'status' => ['required', new Enum(PurchaseStatus::class)],
            'payment_method' => ['required', new Enum(PaymentMethod::class)],
            'note' => 'nullable|string',
            'document' => 'nullable|mimes:jpg,jpeg,png',
        ];
    }
}
