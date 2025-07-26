<?php

namespace App\Http\Requests\Repair;

use App\Http\Requests\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;

class RepairAllFilterRequest extends FormRequest
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
        $request = array_merge_recursive($request, [
            "sort:Status:P" => "nullable|boolean",
            "sort:Status:C" => "nullable|boolean"
        ]);
        return $request;
    }
}
