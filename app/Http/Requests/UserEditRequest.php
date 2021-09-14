<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'max:120|string',
            'last_name' => 'max:120|string',
            'email' => 'string|email',
            'role' => 'required|max:7',
            'password' => 'string|min:8|confirmed',
            'img' => 'image|mimes:jpg,bmp,png,jpeg|max:2048|nullable'
        ];
    }
}
