<?php

namespace App\Http\Requests\Phone;

use App\Http\Requests\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="PhoneAllFilterRequest",
 *     type="object",
 *     @OA\Property(
 *         property="search:value",
 *         type="string",
 *         nullable=true,
 *         description="Search value for filtering results"
 *     ),
 *     @OA\Property(
 *         property="sort:newest",
 *         type="boolean",
 *         nullable=true,
 *         description="Sort by newest first"
 *     ),
 *     @OA\Property(
 *         property="sort:oldest",
 *         type="boolean",
 *         nullable=true,
 *         description="Sort by oldest first"
 *     ),
 *     @OA\Property(
 *         property="sort:Price:HTL",
 *         type="boolean",
 *         nullable=true,
 *         description="Sort Price Highest to Lowest"
 *     ),
 *     @OA\Property(
 *         property="sort:Price:LTH",
 *         type="boolean",
 *         nullable=true,
 *         description="Sort Price Lowest to Highest"
 *     ),
 *      @OA\Property(
 *         property="sort:Status:A",
 *         type="boolean",
 *         nullable=true,
 *         description="show only status avaliable"
 *     ),
 *     @OA\Property(
 *         property="sort:Status:S",
 *         type="boolean",
 *         nullable=true,
 *         description="show only status sold"
 *     )
 * )
 */
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
