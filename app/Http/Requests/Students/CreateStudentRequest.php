<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class CreateStudentRequest extends FormRequest
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
            'name'         => 'required',
            'email'        => 'required|string|email|max:255|unique:students',
            'gender'       => 'required',
            'phone_number' => 'nullable|numeric',
            'address'      => 'nullable',
            'password'     => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'   => 'min:6',
            'url_image'    => 'nullable',
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
