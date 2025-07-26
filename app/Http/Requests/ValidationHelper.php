<?php

namespace App\Http\Requests;

class ValidationHelper
{

    public static function basicValidationRules()
    {
        return [
            "search:value" => "nullable|string", // it is from string
            "sort:newest" => "nullable|boolean",
            "sort:oldest" => "nullable|boolean",
        ];
    }
    
}