<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'kerjasama_id' => 'required',
            'devisi_id' => 'required',
            'name'      => 'required',
            'email'     => 'email:rfc',
            'password'  => 'required',
            'image'     => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'deskripsi' => 'nullable'
        ];
    }
}
