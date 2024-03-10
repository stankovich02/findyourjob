<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserByAdminRequest extends FormRequest
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
            "email" => "required|email|unique:users,email",
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            'role' => 'required|integer|exists:roles,id',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages() : array
    {
        return [
            'firstName.regex' => 'First name must contain only letters and spaces. Example: John',
            'lastName.regex' => 'Last name must contain only letters and spaces. Example: Doe',
            'email.email' => 'Email is not in valid format. Example: jhondoe@gmail.com',
            'password.regex' => 'Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter and one number. Example: JohnDoe123',
            'role.exists' => 'Role does not exist.'
        ];
    }
}
