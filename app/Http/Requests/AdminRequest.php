<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string| max:255',
            'email'         => 'required|email|unique:admins,email|max:255',
            'gender'        => 'required| in:Male,Female',
            'phone_number'  => 'nullable|numeric|', //max:15
            'address'       => 'nullable| max:255',
            'password'      => 'required| min:8| confirmed| max:255',
            'url_image'     => 'nullable| max:255',
            'status'        => 'boolean| in:0,1',
        ];
    }
}
