<?php

namespace App\Http\Requests\Web\Applicant\ApplicationProcessing;

use Illuminate\Foundation\Http\FormRequest;

class ProcessApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subject_id' => ['required', 'uuid'],
            'grade_id' => ['required', 'uuid'],
        ];
    }

    public function messages()
    {
        return [
            'subject_id.required' => 'Subject is required',
            'subject_id.uuid' => 'Subject is not valid',
            'grade_id.required' => 'Grade is required',
            'grade_id.uuid' => 'Grade is not valid'
        ];
    }
}
