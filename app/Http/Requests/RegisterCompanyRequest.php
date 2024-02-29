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
            "companyName" => "required|unique:companies,companyName",
           /* "logo" => "required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=150,min_height=150",*/
            "website" => "nullable|url|unique:companies,website",
            "phone" => "required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
            "email" => "required|email|unique:companies,email",
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "confirmPassword" => "required|same:password",
        ];
    }
    public function messages() : array
    {
        return [
            'companyName.unique' => 'Company name already exists.',
            'logo.image' => 'Logo must be an image.',
            'logo.mimes' => 'Logo must be in jpeg, png or jpg format.',
            'logo.max' => 'Logo must be smaller than 2MB.',
            'logo.dimensions' => 'Logo must be at least 150x150 pixels.',
            'website.url' => 'Website is not in valid format. Example: https://www.company.com',
            'website.unique' => 'Website already exists.',
            'email.email' => 'Email is not in valid format. Example: company@gmail.com',
            'email.unique' => 'Email already exists.',
            'password.regex' => 'Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter and one number. Example: JohnDoe123',
            'confirmPassword.same' => 'Passwords do not match.',
        ];
    }
}
