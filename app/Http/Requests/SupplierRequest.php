<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SupplierRequest extends FormRequest
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
        $isRequired = 'required';
        if ($method) {
            $isRequired = 'nullable';
        }

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->supplier?->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $this->supplier?->id,
            'password' => $isRequired . '|string|min:8',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'company_name' => 'nullable|string|max:255',
            'busniss_phone_number' => 'nullable|string|max:255',
            'busniss_email' => 'nullable|email|max:255',
            'vat_number' => 'nullable|string|max:255',
            'status' => ['required', new Enum(Status::class)]
        ];
    }
}
