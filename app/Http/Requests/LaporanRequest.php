<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
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
            'client_id' => 'required',
            'image1' => 'required|mimes:png,jpg,jpeg|max:3072',
            'image2' => 'nullable|mimes:png,jpg,jpeg|max:3072',
            'image3' => 'required|mimes:png,jpg,jpeg|max:3072',
            'keterangan' => 'required'
        ];
    }
}
