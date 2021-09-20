<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
            "name" => "required|max:120|string",
            "last_name" => "required|max:120|string",
            "email" => "required|string|email|unique:users,email",
            "password" => "required|string|min:8|confirmed",
            "img" => "image|mimes:jpg,bmp,png,jpeg|max:20480|nullable"
        ];
    }
}
