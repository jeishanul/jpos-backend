<?php

namespace App\Http\Requests;

use App\Enums\CurrencyPosition;
use App\Enums\DateFormat;
use App\Enums\DateSeparator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SettingsRequest extends FormRequest
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
            'system_name' => 'required|string|max:255',
            'logo' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'favicon' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'small_logo' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'developed_by' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'currency_id' => 'required|integer',
            'currency_position' => ['required', new Enum(CurrencyPosition::class)],
            'date_format' => ['required', new Enum(DateFormat::class)],
            'date_separator' => ['required', new Enum(DateSeparator::class)]
        ];
    }
}
