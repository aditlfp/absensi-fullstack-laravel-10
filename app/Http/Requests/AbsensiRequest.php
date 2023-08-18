<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsensiRequest extends FormRequest
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
            'user_id'       => 'required',
            'kerjasama_id'  => 'required',
            'shift_id'      => 'required',
            'perlengkapan'  => 'required',
            'keterangan'    => 'required',
            'absensi_type_masuk'  => 'required',
            'absensi_type_pulang'  => 'nullable',
            'image'       => 'required',
            'deskripsi' => 'nullable',
            'point_id' => 'nullable'

        ];
    }
}
