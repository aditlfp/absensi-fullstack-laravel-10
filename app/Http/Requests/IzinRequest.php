<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzinRequest extends FormRequest
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
            'shift_id' => 'required',
            'alasan_izin' => 'required',
            'img' => 'required',
            'status_approve' => 'nullable'
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Nama Harus Diisi', 
            'kerjasama_id.required' => 'Client Harus Diisi',
            'shift_id.required' => 'Shift Tidak Boleh Kosong',
            'alasan_izin.required' => 'Alasan Tidak Boleh Kosong',
            'img.required' => 'Gambar Tidak Boleh Kosong',
        ];
    }
}
