<?php

namespace App\Http\Requests\Web\Applicant\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class ProcessApplicantLoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'between:3,150', 'email'],
            'password' => ['required', 'between:8,20'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email Address is required',
            'email.between' => 'Email Address must be between 3 to 150 characters',
            'email.email' => 'Email Address is not valid',
            'password.required' => 'Password is required',
            'password.between' => 'Password must be 8 to 20 characters',
        ];
    }
}
