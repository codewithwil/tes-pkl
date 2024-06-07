<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'                  => 'nullable|min:3',
            'telepon'               => 'nullable|min:10',
            'alamat'                => 'nullable|max:255',
            'email'                 => 'required|email',
            'level'                  => 'nullable',
            'password'              => 'nullable|min:8|confirmed',
            'password_repeat'       => 'nullable|min:8'
        ];
    }
}
