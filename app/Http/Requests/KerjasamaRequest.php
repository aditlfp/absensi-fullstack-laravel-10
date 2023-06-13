<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KerjasamaRequest extends FormRequest
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
            'value'     => 'required',
            'experied'  => 'required',
            'approve1'  => 'required',
            'approve2'  => 'required',
            'approve3'  => 'required',
        ];
    }
}
