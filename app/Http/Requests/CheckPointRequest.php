<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckPointRequest extends FormRequest
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
            'user_id' => 'required',
            'divisi_id' => 'required',
            'type_check' => 'nullable',
            'img' => 'required|image|mimes:png,jpg,svg,gif,jpeg|max:3048',
            'deskripsi' => 'required'
        ];
    }
}
