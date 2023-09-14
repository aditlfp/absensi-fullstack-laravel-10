<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'check_point_id' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,PNG,JPG,JPEG,GIF|max:3048',
            'image.*' => 'image|mimes:png,jpg,jpeg,gif,PNG,JPG,JPEG,GIF|max:3048'
        ];
    }
}
