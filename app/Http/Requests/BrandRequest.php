<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BrandRequest extends FormRequest
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
            'image' => $isImageRequired . '|mimes:jpg,jpeg,png,gif',
            'status' => ['required', new Enum(Status::class)]
        ];
    }
}
