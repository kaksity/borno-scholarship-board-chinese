<?php

namespace App\Http\Requests\Web\Admin\Reports;

use Illuminate\Foundation\Http\FormRequest;

class GenerateReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'year' => ['nullable', 'string'],
            'course_of_study_id' => ['nullable', 'uuid'],
            'status' => ['nullable', 'in:Applying,Submitted'],
            'has_passed_grade_point' => ['nullable', 'in:Yes,No'],
        ];
    }
}
