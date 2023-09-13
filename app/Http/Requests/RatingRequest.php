<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'leader_name' => 'nullable',
            'mitra_name' => 'nullable',
            'isLeader' => 'nullable',
            'isMitra' => 'nullable',
            'user_id' => 'required',
            'rate' => 'required',
        ];
    }
}
