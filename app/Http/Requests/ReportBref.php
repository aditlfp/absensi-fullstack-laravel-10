<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportBref extends FormRequest
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
            'client_id' => 'required',
            'tanggal' => 'required',
            'shift' => 'required',
            'hadir' => 'nullable',
            'spv' => 'nullable',
            'tl' => 'nullable',
            'ocs' => 'nullable',
            'tanpa_keterangan' => 'nullable',
            'izin_atau_cuti' => 'nullable',
            'sakit' => 'nullable',
            'off' => 'nullable',
            'total_mp' => 'nullable',
            'materi_breafing' => 'required'
        ];
    }
}
