<?php

namespace App\Http\Requests\Web\Applicant\UploadManagement;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUploadDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'document_type_id' => ['required', 'uuid'],
            'file' => ['required', 'file', 'max:1024', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'document_type_id.required' => 'Document type is required',
            'document_type_id.uuid' => 'Document type is not valid',
            'file.required' => 'Document is required',
            'file.file' => 'Document must be a file',
            'file.max' => 'Document must not exceed 1mb',
            'file.image' => 'Document must be an image',
        ];
    }
}
