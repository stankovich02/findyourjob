<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
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
            "companyName" => "required|unique:companies,name",
            "website" => "nullable|url|unique:companies,website",
            "phone" => "required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
            "email" => "required|email|unique:companies,email",
            "description" => "required|string|min:50",
            "cities" => "required",
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "confirmPassword" => "required|same:password",
        ];
    }
    public function messages() : array
    {
        return [
            'companyName.unique' => 'Company name already exists.',
            'website.url' => 'Website is not in valid format. Example: https://www.company.com',
            'website.unique' => 'Website already exists.',
            'email.email' => 'Email is not in valid format. Example: company@gmail.com',
            'email.unique' => 'Email already exists.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string.',
            'description.min' => 'Description must contain at least 50 characters.',
            'phone.required' => 'Phone is required.',
            'phone.regex' => 'Phone is not in valid format. Example: +1234567890',
            'cities.required' => 'Please select at least one city.',
            'password.regex' => 'Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter and one number. Example: JohnDoe123',
            'confirmPassword.same' => 'Passwords do not match.',
        ];
    }
}
