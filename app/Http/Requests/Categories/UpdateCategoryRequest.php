<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    use ApiResponseTrait;
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'         => 'string',
            'section_id' => 'exists:sections,id',
            'status'       => 'boolean',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                // response()->json(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST)
                $this->apiResponse(null, $errors, Response::HTTP_NOT_FOUND)
            );
        }

        parent::failedValidation($validator);
    }
}

