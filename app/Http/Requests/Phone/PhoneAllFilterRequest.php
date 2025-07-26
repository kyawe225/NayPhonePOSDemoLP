<?php

namespace App\Http\Requests\Phone;

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
            "sort:Price:HTL" => "nullable|boolean|accepted",
            "sort:Price:LTH" => "nullable|boolean|accepted",
            "sort:Status:A" => "nullable|boolean|accepted",
            "sort:Status:S" => "nullable|boolean|accepted"
        ]);
        return $request;
    }
}
