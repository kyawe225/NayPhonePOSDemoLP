<?php

namespace App\Http\Requests\Repair;

use Illuminate\Foundation\Http\FormRequest;

class RepairCreateRequest extends FormRequest
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
            'customer_id'=>"required|string",
            "phone_model"=>"required|string",
            "issue"=>"required|string",
            "cost"=>"required|integer",
            "status"=>"required|string|in:pending,in_progress,completed,on_hold,cancelled"
        ];
    }
}
