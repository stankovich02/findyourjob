<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostJobRequest extends FormRequest
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
            'name' => 'required|min:5',
            'category' => 'required',
            'seniority' => 'required',
            'workplace' => 'required',
            'technologies' => 'required',
            'description' => 'required|string|min:50',
            'responsibilities' => 'required|string|min:50',
            'qualifications' => 'required|string|min:50',
            'benefits' => 'required|string|min:50',
            'location' => 'required',
            'salary' => 'nullable|numeric',
            'workType' => 'required',
            'applicationDeadline' => 'required|date',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 5 characters',
            'category.required' => 'Category is required',
            'seniority.required' => 'Seniority is required',
            'workplace.required' => 'Workplace is required',
            'technologies.required' => 'Technologies is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description must be at least 50 characters',
            'responsibilities.required' => 'Responsibilities is required',
            'responsibilities.min' => 'Responsibilities must be at least 50 characters',
            'qualifications.required' => 'Qualifications is required',
            'qualifications.min' => 'Qualifications must be at least 50 characters',
            'benefits.required' => 'Benefits is required',
            'benefits.min' => 'Benefits must be at least 50 characters',
            'location.required' => 'Location is required',
            'applicationDeadline.required' => 'Application Deadline is required',
            'applicationDeadline.date' => 'Application Deadline must be a date',
        ];
    }
}
