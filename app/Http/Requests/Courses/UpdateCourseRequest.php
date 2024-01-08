<?php

namespace App\Http\Requests\Courses;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdateCourseRequest extends FormRequest
{
    use ApiResponseTrait;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|max:50',
            'teacher_id' => 'exists:teachers,id',
            'category_sub_id' => 'exists:category_subs,id',
            'description' => 'string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'price' => 'numeric',//|min:0|max:100',
            'discount' => 'nullable|numeric',//|min:0|max:100',
            'url_image' => 'nullable',//|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'boolean',

            // 'name' => 'required|string',
            // 'teacher_id' => 'required',
            // 'catigory_id' => 'required',
            // 'description' => 'required',
            // 'start_date' => 'nullable',
            // 'end_date' => 'nullable',
            // 'price' => 'required',
            // 'discount' => 'nullable',
            // 'url_image' => 'nullable|string',
            // 'status' => 'required|boolean',
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'name.required' => 'The name field is required.',
    //         'name.string' => 'The name field must be a string.',
    //         'name.max' => 'The name field must not exceed 50 characters.',
    //         'teacher_id.required' => 'The teacher ID field is required.',
    //         'teacher_id.exists' => 'The selected teacher ID is invalid.',
    //         'category_id.required' => 'The category ID field is required.',
    //         'category_id.exists' => 'The selected category ID is invalid.',
    //         'description.required' => 'The description field is required.',
    //         'description.string' => 'The description field must be a string.',
    //         'start_date.date' => 'The start date must be a valid date.',
    //         'end_date.date' => 'The end date must be a valid date.',
    //         'price.required' => 'The price field is required.',
    //         'price.numeric' => 'The price field must be a numeric value.',
    //         'discount.required' => 'The discount field is required.',
    //         'discount.numeric' => 'The discount field must be a numeric value.',
    //         'url_image.required' => 'The URL image field is required.',
    //         'url_image.url' => 'The URL image field must be a valid URL.',
    //         'status.boolean' => 'The status field must be a boolean value.',
    //     ];
    // }


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
