<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComapnyDetailsRequest extends FormRequest
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
            "companyName" => "required",
            "website" => "nullable|url",
            "phone" => "required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
            "email" => "required|email",
        ];
    }
    public function messages()
    {
        return [
            'website.url' => 'Website is not in valid format. Example: https://www.company.com',
            'phone.regex' => 'Phone number is not in valid format. Example: 0234567890',
            'email.email' => 'Email is not in valid format. Example: company@gmail.com'
        ];
    }
}
