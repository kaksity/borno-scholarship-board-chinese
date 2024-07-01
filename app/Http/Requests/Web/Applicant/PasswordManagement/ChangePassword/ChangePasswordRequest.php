<?php

namespace App\Http\Requests\Web\Applicant\PasswordManagement\ChangePassword;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'between:8,20'],
            'new_password' => ['required', 'between:8,20', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Old Password is required',
            'old_password.between' => 'Old Password must be 8 to 20 characters',
            'old_password.confirmed' => 'Old Password must match confirm password',
            'new_password.required' => 'New Password is required',
            'new_password.between' => 'New Password must be 8 to 20 characters',
            'new_password.confirmed' => 'New Password must match Confirm password',
        ];
    }
}
