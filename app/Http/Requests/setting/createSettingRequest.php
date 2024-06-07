<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class createSettingRequest extends FormRequest
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
            'nama_perusahaan'   => 'required',
            'foto_perusahaan'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon'           => 'nullable|max:12',
            'email'             => 'nullable|email',
            'nib'               => 'nullable|max:16',
            'web'               => 'nullable|',
            'alamat'            => 'nullable|max:255',
            'kodepos'           => 'nullable|max:11',
        ];
    }
}
