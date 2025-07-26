<?php

namespace App\Http\Requests\Phone;

use App\Http\Requests\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;

class PhoneAllFilterRequest extends FormRequest
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
            "sort:Price:HTL" => "nullable|boolean",
            "sort:Price:LTH" => "nullable|boolean",
            "sort:Status:A" => "nullable|boolean",
            "sort:Status:S" => "nullable|boolean"
        ]);
        return $request;
    }
}
