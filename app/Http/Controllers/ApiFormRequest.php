<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @author Ryan
 * Class ApiFormRequest
 * @package App\Modules\Core
 */
class ApiFormRequest extends FormRequest
{
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $firstError = collect($errors)->values()->first()[0];

        throw new HttpResponseException(
            Response::json(
                [
                    'status' => 'error',
                    'message' => $firstError,
                    'errors' => $errors
                ],
                422
            )
        );
    }
}
