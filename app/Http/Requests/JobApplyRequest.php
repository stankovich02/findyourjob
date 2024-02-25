<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplyRequest extends FormRequest
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
            'uploadedFile' => 'required|file|mimes:doc,docx,pdf|max:2048',
            'coverLetter' => 'required|string|min:50',
        ];
    }
    public function messages(): array
    {
        return [
            'uploadedFile.required' => 'Please upload a file',
            'uploadedFile.file' => 'Please upload a file',
            'uploadedFile.mimes' => 'Please upload a file of type: doc, docx, pdf',
            'uploadedFile.max' => 'Please upload a file of max size: 2MB',
            'coverLetter.required' => 'Cover letter is required',
            'coverLetter.string' => 'Cover letter must be a string',
            'coverLetter.min' => 'Cover letter must be at least 50 characters',
        ];
    }
}
