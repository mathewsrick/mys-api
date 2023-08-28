<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.max' => 'El numero debe ser de maximo 10 digitos',
        ];
    }
}
