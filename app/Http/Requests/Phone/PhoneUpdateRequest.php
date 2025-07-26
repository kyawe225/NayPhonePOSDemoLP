<?php

namespace App\Http\Requests\Phone;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateRequest extends FormRequest
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
            "brand"=>"required|string",
            "model"=>"required|string",
            "price"=>"required|integer",
            "status"=>"required|string",
            "customer_id"=>"required|string",
            "imei"=>"required|string",
            "damage_percent"=>"nullable|integer",
            "gift"=>"nullable|string",
            "category"=>"nullable|string",
            "discount_amount"=>"nullable|integer|requiredif:discount_type",
            "discount_type"=>"nullable|string|requiredif:discount_amount"
        ];
    }
}
