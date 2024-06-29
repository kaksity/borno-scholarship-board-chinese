<?php

namespace App\Http\Requests\Web\Applicant\ProfileManagement;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'surname' => ['required', 'between:3,150'],
            'other_names' => ['required', 'between:3,150'],
            'phone_number' => ['required', 'string', 'between:10,20'],
            'nin' => ['required', 'string', 'digits:11'],
            'lga_id' => ['required', 'string', 'uuid'],
        ];
    }

    public function messages()
    {
        return [
            'surname.required' => 'Surname is required',
            'surname.between' => 'Surname must be between 3 to 150 characters',
            'other_names.required' => 'Other names is required',
            'other_names.between' => 'Other names must be between 3 to 150 characters',
            'phone_number.required' =>  'Phone number is required',
            'phone_number.between' =>  'Phone number must be between 10 to 20 characters',
            'nin.required' => 'National Identity Number is required',
            'nin.string' => 'National Identity Number must be a string',
            'nin.digits' => 'National Identity Number must be 11 digits',
        ];
    }
}
