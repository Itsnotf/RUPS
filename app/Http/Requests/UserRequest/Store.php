<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_Kompartement' => 'required',
            'id_Department' => 'required',
            'id_Jabatan' => 'required',
            'name' => 'required|max:255',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'avatar' => 'nullable|max:2048|mimes:jpg,jpeg,png,gif',
        ];
    }
}
