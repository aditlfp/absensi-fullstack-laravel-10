<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'      => 'required|string',
            'address'   => 'required',
            'province'  => 'required',
            'kabupaten' => 'required',
            'zipcode'   => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'fax'       => 'required',
            'logo'      => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ];
    }
}
