<?php

namespace App\Models;

class ApplicantUploadedDocumentData extends AbstractModel
{
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }
}
