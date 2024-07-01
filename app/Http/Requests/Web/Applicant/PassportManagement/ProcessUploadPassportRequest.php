<?php

namespace App\Http\Requests\Web\Applicant\PassportManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessUploadPassportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'passport' => ['required', 'file', 'max:1024', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'passport.required' => 'Passport File is required',
            'passport.file' => 'Passport File must be a file',
            'passport.max' => 'Passport File must not exceed 1mb',
            'passport.image' => 'Passport File must be an image',
        ];
    }
}
