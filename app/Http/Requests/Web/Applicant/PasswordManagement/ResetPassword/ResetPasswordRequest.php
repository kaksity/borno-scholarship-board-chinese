<?php

namespace App\Http\Requests\Web\Applicant\PasswordManagement\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'between:3,150', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email Address is required',
            'email.email' => 'Email Address is not valid',
            'email.between' => 'Email Address must be between 3 to 150 characters',
        ];
    }
}
