<?php

namespace App\Http\Requests\Web\Applicant\ProfileManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessUpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'digits:11'],
            'nin' => ['required', 'digits:11', Rule::unique('applicant_bio_data', 'nin')->ignore($this->user()->id, 'applicant_id')],
            'candidate_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'contact_address' => ['required', 'between:3,200'],
            'lga_id' => ['required', 'uuid'],
            'guardian_full_name' => ['required', 'between:3,200'],
            'place_of_birth' => ['required', 'between:3,200'],
            'gender' => ['required', 'in:Male,Female'],
        ];
    }

    public function messages()
    {
        return [
            'candidate_number.required' =>  'Candidate WAEC Number is required',
            'phone_number.required' => 'Phone Number is required',
            'phone_number.digits' => 'Phone Number must be 11 digits',
            'nin.required' => 'NIN is required',
            'nin.digits' => 'NIN must be 11 digits',
            'nin.unique' => 'NIN has already been used',
            'date_of_birth.required' => 'Date of Birth is required',
            'date_of_birth.date' => 'Date of Birth must be a date',
            'date_of_birth.date_format' => 'Date of Birth Format is not valid',
            'lga_id.required' => 'Local Government Area is required',
            'lga_id.uuid' => 'Local Government Area must be an uuid',
            'contact_address.required' => 'Contact Address is required',
            'contact_address.between' => 'Contact Address must be 3 to 200 characters',
            'place_of_birth.required' => 'Place of birth is required',
            'place_of_birth.between' => 'Place of birth must be 3 to 200 characters',
            'guardian_full_name.required' => 'Guardian Name is required',
            'guardian_full_name.between' => 'Guardian Name must be 3 to 200 characters',
            'gender.required' => 'Gender is required',
            'gender.between' => 'Gender must be 3 to 200 characters',
        ];
    }
}
