<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LemburRequest extends FormRequest
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
            'kerjasama_id' => 'required',
            'perlengkapan' => 'required',
            'keterangan' => 'required',
            'deskripsi' => 'nullable',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable',
            'image' => 'required'
        ];
    }
}
