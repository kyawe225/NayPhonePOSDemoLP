<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;

class CustomerAllFilterRequest extends FormRequest
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
        $request = ValidationHelper::basicValidationRules();
        return $request;
    }
}
