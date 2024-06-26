<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailsRequest extends FormRequest
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
            "firstName" => "required|regex:/^[A-ZČĆĐŽŠ][a-zčćđžš]{2,}(\s[A-ZČĆĐŽŠ][a-zčćđžš]{2,})*$/",
            "lastName" => "required|regex:/\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+/",
            "email" => "required|email",
        ];
    }
    public function messages()
    {
        return [
            'firstName.regex' => 'First name must contain only letters and spaces. Example: John',
            'lastName.regex' => 'Last name must contain only letters and spaces. Example: Doe',
            'email.email' => 'Email is not in valid format. Example: jhondoe@gmail.com',
        ];
    }
}
