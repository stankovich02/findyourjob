<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "currentPassword" => "required",
            "newPassword" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "confirmPassword" => "required|same:newPassword",
        ];
    }
    public function messages() : array
    {
        return [
            'newPassword.regex' => 'Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter and one number. Example: JohnDoe123',
            'confirmPassword.same' => 'Passwords do not match.',
        ];
    }
}
