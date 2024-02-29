<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountPictureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'picture.required' => 'Please select a picture',
            'picture.image' => 'The file must be an image',
            'picture.mimes' => 'The image must be of type: jpeg, png, jpg',
            'picture.max' => 'The image must be smaller than 2MB'
        ];
    }
}
